<?php

class DbConnector {
    private $conn;

    public function __construct() {
        $servername = "localhost"; // Update with your MySQL server address
        $username = "root"; // Update with your MySQL username
        $password = ""; // Update with your MySQL password
        $dbname = "db_manunggalretail"; // Update with your MySQL database name

        try {
            $this->conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($this->conn->connect_error) {
                die("Connection failed: " . $this->conn->connect_error);
            }
        } catch (Exception $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function getConnection() {
        return $this->conn;
    }

    // Fungsi untuk menampilkan data tb_member
    public function getMembers() {
        try {
            $query = "SELECT id_member, nama_member, foto, alamat, email, telepon, nama_team, keterangan FROM tb_member";
            $result = $this->conn->query($query);

            $memberData = array();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $memberData[] = $row;
                }
            }

            return $memberData;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return array(); // Return an empty array in case of an error
        }
    }

    // Fungsi untuk menambah data tb_member
    public function addMember($nama_member, $foto, $alamat, $email, $telepon, $nama_team, $keterangan) {
        // File upload handling
        $targetDir = "uploads/member/";
        $targetFile = $targetDir . basename($foto["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Check if file already exists
        if (file_exists($targetFile)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Check file size
        if ($foto["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($foto["tmp_name"], $targetFile)) {
                echo "The file " . htmlspecialchars(basename($foto["name"])) . " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }

        // Insert data into tb_member
        $stmt = $this->conn->prepare("INSERT INTO tb_member (nama_member, foto, alamat, email, telepon, nama_team, keterangan) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $nama_member, $targetFile, $alamat, $email, $telepon, $nama_team, $keterangan);

        if ($stmt->execute()) {
            $stmt->close();
            return true; // Insertion successful
        } else {
            $stmt->close();
            echo "Failed to add member.";
            return false; // Insertion failed
        }
    }

    // Fungsi untuk mengedit data tb_member
    public function editMember($id_member, $nama_member, $foto, $alamat, $email, $telepon, $nama_team, $keterangan) {
        // File upload handling (similar to addMember method)
        $targetDir = "uploads/member/";
        $targetFile = $targetDir . basename($foto["name"]);
        move_uploaded_file($foto["tmp_name"], $targetFile);

        // Update data in tb_member
        $stmt = $this->conn->prepare("UPDATE tb_member SET nama_member = ?, foto = ?, alamat = ?, email = ?, telepon = ?, nama_team = ?, keterangan = ? WHERE id_member = ?");
        $stmt->bind_param("sssssssi", $nama_member, $targetFile, $alamat, $email, $telepon, $nama_team, $keterangan, $id_member);

        if ($stmt->execute()) {
            $stmt->close();
            return true; // Update successful
        } else {
            $stmt->close();
            // Display the SQL error for debugging purposes
            die("Error: " . $this->conn->error);
            return false; // Update failed
        }
    }

    // Helper method to get the existing photo path by member ID
    private function getPhotoPathByIdMember($id_member) {
        $stmt = $this->conn->prepare("SELECT foto FROM tb_member WHERE id_member = ?");
        $stmt->bind_param("i", $id_member);
        $stmt->execute();
        $stmt->bind_result($existingPhoto);
        $stmt->fetch();
        $stmt->close();

        return $existingPhoto;
    }

    // Fungsi untuk mengambil data tb_member berdasarkan id_member
    public function getMemberById($id_member) {
        $stmt = $this->conn->prepare("SELECT id_member, nama_member, foto, alamat, email, telepon, nama_team, keterangan FROM tb_member WHERE id_member = ?");
        $stmt->bind_param("i", $id_member);
        $stmt->execute();
        $stmt->bind_result($id_member, $nama_member, $foto, $alamat, $email, $telepon, $nama_team, $keterangan);
        $stmt->fetch();
        $stmt->close();

        if ($id_member !== null) {
            return [
                'id_member' => $id_member,
                'nama_member' => $nama_member,
                'foto' => $foto,
                'alamat' => $alamat,
                'email' => $email,
                'telepon' => $telepon,
                'nama_team' => $nama_team,
                'keterangan' => $keterangan,
            ];
        } else {
            return null; // Member not found
        }
    }

    // Fungsi untuk menghapus data tb_member
    public function deleteMember($id_member) {
        try {
            // Prepare and execute the DELETE query
            $stmt = $this->conn->prepare("DELETE FROM tb_member WHERE id_member = ?");
            $stmt->bind_param("i", $id_member);

            if ($stmt->execute()) {
                $stmt->close();
                return true; // Deletion successful
            } else {
                $stmt->close();
                return false; // Deletion failed
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return false; // Deletion failed
        }
    }

    // Function to get member data by team
    public function getMemberByTeam($teamName) {
        try {
            // Using a prepared statement to prevent SQL injection
            $stmt = $this->conn->prepare("SELECT * FROM tb_member WHERE nama_team = ?");
            $stmt->bind_param("s", $teamName);
            $stmt->execute();

            // Fetch the data as an associative array
            $result = $stmt->get_result();
            $memberData = array();

            while ($row = $result->fetch_assoc()) {
                $memberData[] = $row;
            }

            $stmt->close();

            return $memberData;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return array(); // Return an empty array if an error occurs
        }
    }

    // Fungsi untuk menampilkan data tb_services
    public function getServices() {
        try {
            $query = "SELECT id_services, nama_services, foto, keterangan FROM tb_services";
            $result = $this->conn->query($query);

            $servicesData = array();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $servicesData[] = $row;
                }
            }

            return $servicesData;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return array(); // Return an empty array in case of an error
        }
    }

    // Fungsi untuk menambah data tb_services
    public function addService($nama_services, $foto, $keterangan) {
        // File upload handling
        $targetDir = "uploads/services/"; // Adjust the directory as needed
        $targetFile = $targetDir . basename($foto["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Check if file already exists
        if (file_exists($targetFile)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }
    
        // Check file size
        if ($foto["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
    
        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
    
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($foto["tmp_name"], $targetFile)) {
                echo "The file " . htmlspecialchars(basename($foto["name"])) . " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }

        // Insert data into tb_services
        $stmt = $this->conn->prepare("INSERT INTO tb_services (nama_services, foto, keterangan) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nama_services, $targetFile, $keterangan);

        if ($stmt->execute()) {
            $stmt->close();
            return true; // Insertion successful
        } else {
            $stmt->close();
            echo "Failed to add news.";
            return false; // Insertion failed
        }
    }

    // Fungsi untuk menampilkan data tb_services berdasarkan id_services
    public function getServiceById($id_services) {
        // Select data from tb_services based on id_services
        $stmt = $this->conn->prepare("SELECT id_services, nama_services, foto, keterangan FROM tb_services WHERE id_services = ?");
        $stmt->bind_param("i", $id_services);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $stmt->close();
            return $row;
        } else {
            $stmt->close();
            return null; // Service not found
        }
    }

    // Fungsi untuk mengedit data tb_services
    public function editService($id_services, $nama_services, $foto, $keterangan) {
        // Check if a new photo is provided
        $existingPhotoPath = $this->getPhotoPathByIdServices($id_services);

        if (!empty($foto['name'])) {
            // File upload handling
            $targetDir = "uploads/services/";
            $targetFile = $targetDir . basename($foto["name"]);
            move_uploaded_file($foto["tmp_name"], $targetFile);
        } else {
            // No new photo provided, use the existing photo path from the database
            $targetFile = $existingPhotoPath;
        }

        // Update data in tb_services
        $stmt = $this->conn->prepare("UPDATE tb_services SET nama_services = ?, foto = ?, keterangan = ? WHERE id_services = ?");
        $stmt->bind_param("sssi", $nama_services, $targetFile, $keterangan, $id_services);

        if ($stmt->execute()) {
            $stmt->close();
            return true; // Update successful
        } else {
            $stmt->close();
            return false; // Update failed
        }
    }

    // Helper method to get the existing photo path by id_services
    private function getPhotoPathByIdServices($id_services) {
        $stmt = $this->conn->prepare("SELECT foto FROM tb_services WHERE id_services = ?");
        $stmt->bind_param("i", $id_services);
        $stmt->execute();
        $stmt->bind_result($existingPhoto);
        $stmt->fetch();
        $stmt->close();

        return $existingPhoto;
    }

    // Fungsi untuk menghapus data tb_services
    public function deleteService($id_services) {
        // Delete data from tb_services
        $stmt = $this->conn->prepare("DELETE FROM tb_services WHERE id_services = ?");
        $stmt->bind_param("i", $id_services);

        if ($stmt->execute()) {
            $stmt->close();
            return true; // Deletion successful
        } else {
            $stmt->close();
            return false; // Deletion failed
        }
    }

    // Fungsi untuk menampilkan data tb_member
    public function getProjects() {
        try {
            $query = "SELECT id_project, nama_project, foto, customer, lokasi, selesai, tipe_pekerjaan, keterangan FROM tb_project";
            $result = $this->conn->query($query);

            $projectData = array();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $projectData[] = $row;
                }
            }

            return $projectData;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return array(); // Return an empty array in case of an error
        }
    }

    // Fungsi untuk menambah data tb_project
    public function addProject($nama_project, $foto, $customer, $lokasi, $selesai, $tipe_pekerjaan, $keterangan) {
        // File upload handling
        $targetDir = "uploads/projects/";
        $targetFile = $targetDir . basename($foto["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Check if file already exists
        if (file_exists($targetFile)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }
    
        // Check file size
        if ($foto["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
    
        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
    
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($foto["tmp_name"], $targetFile)) {
                echo "The file " . htmlspecialchars(basename($foto["name"])) . " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }

        // Insert data into tb_project
        $stmt = $this->conn->prepare("INSERT INTO tb_project (nama_project, foto, customer, lokasi, selesai, tipe_pekerjaan, keterangan) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $nama_project, $targetFile, $customer, $lokasi, $selesai, $tipe_pekerjaan, $keterangan);

        if ($stmt->execute()) {
            $stmt->close();
            return true; // Insertion successful
        } else {
            $stmt->close();
            echo "Failed to add news.";
            return false; // Insertion failed
        }
    }

    // Fungsi untuk menampilkan data tb_project berdasarkan id_project
    public function getProjectById($id_project) {
        // Retrieve project data from tb_project based on id_project
        $query = "SELECT id_project, nama_project, foto, customer, lokasi, selesai, tipe_pekerjaan, keterangan FROM tb_project WHERE id_project = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id_project);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $projectData = $result->fetch_assoc();
            $stmt->close();

            return $projectData;
        } else {
            $stmt->close();
            return null; // Return null if the query fails
        }
    }

    // Fungsi untuk mengedit data tb_project
    public function editProject($id_project, $nama_project, $foto, $customer, $lokasi, $selesai, $tipe_pekerjaan, $keterangan) {
        // Check if a new photo is provided
        if (!empty($foto['name'])) {
            // File upload handling
            $targetDir = "uploads/projects/";
            $targetFile = $targetDir . basename($foto["name"]);
            move_uploaded_file($foto["tmp_name"], $targetFile);
        } else {
            // No new photo provided, use the existing photo path from the database
            $targetFile = $this->getPhotoPathById($id_project, "tb_project", "foto");
        }

        // Update data in tb_project
        $stmt = $this->conn->prepare("UPDATE tb_project SET nama_project = ?, foto = ?, customer = ?, lokasi = ?, selesai = ?, tipe_pekerjaan = ?, keterangan = ? WHERE id_project = ?");
        $stmt->bind_param("sssssssi", $nama_project, $targetFile, $customer, $lokasi, $selesai, $tipe_pekerjaan, $keterangan, $id_project);

        if ($stmt->execute()) {
            $stmt->close();
            return true; // Update successful
        } else {
            $stmt->close();
            return false; // Update failed
        }
    }

    // Fungsi untuk menghapus data tb_project
    public function deleteProject($id_project) {
        // Delete data from tb_project
        $stmt = $this->conn->prepare("DELETE FROM tb_project WHERE id_project = ?");
        $stmt->bind_param("i", $id_project);

        if ($stmt->execute()) {
            $stmt->close();
            return true; // Deletion successful
        } else {
            $stmt->close();
            return false; // Deletion failed
        }
    }

    // Fungsi untuk menampilkan data tb_client
    public function getClients() {
        // Retrieve all client data from tb_client
        $result = $this->conn->query("SELECT id_client, nama_client, foto, link, keterangan FROM tb_client");

        $clientsData = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Assuming 'foto' column contains only the file name
                $row['imagePath'] = 'uploads/client/' . $row['foto'];
                $clientsData[] = $row;
            }
        }

        return $clientsData;
    }

    // Fungsi untuk menambah data tb_client
    public function addClient($nama_client, $foto, $link, $keterangan) {
        // File upload handling
        $targetDir = "uploads/client/"; // Create a directory called "uploads" in the same directory as your PHP files
        $targetFile = $targetDir . basename($foto["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        if (isset($_POST["submit"])) {
            $check = getimagesize($foto["tmp_name"]);
            if ($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }

        // Check if file already exists
        if (file_exists($targetFile)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Check file size
        if ($foto["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if (
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif"
        ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($foto["tmp_name"], $targetFile)) {
                echo "The file " . htmlspecialchars(basename($foto["name"])) . " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }

        // Insert data into tb_client
        $stmt = $this->conn->prepare("INSERT INTO tb_client (nama_client, foto, link, keterangan) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nama_client, $targetFile, $link, $keterangan);

        if ($stmt->execute()) {
            $stmt->close();
            return true; // Insertion successful
        } else {
            $stmt->close();
            // Display the SQL error for debugging purposes
            die("Error: " . $this->conn->error);
            return false; // Insertion failed
        }
    }
    
    // Fungsi untuk memperbarui data tb_client
    public function editClient($id_client, $nama_client, $newFoto, $link, $keterangan) {
        // Check if a new photo is provided
        if (!empty($newFoto['name'])) {
            // File upload handling (same as in the addClient method)
            $targetDir = "uploads/client/";
            $targetFile = $targetDir . basename($newFoto["name"]);
            move_uploaded_file($newFoto["tmp_name"], $targetFile);
        } else {
            // No new photo provided, use the existing photo path from the database
            $targetFile = $this->getPhotoPathById($id_client);
        }

        // Update data in tb_client
        $stmt = $this->conn->prepare("UPDATE tb_client SET nama_client = ?, foto = ?, link = ?, keterangan = ? WHERE id_client = ?");
        $stmt->bind_param("ssssi", $nama_client, $targetFile, $link, $keterangan, $id_client);

        if ($stmt->execute()) {
            $stmt->close();
            return true; // Update successful
        } else {
            $stmt->close();
            // Display the SQL error for debugging purposes
            die("Error: " . $this->conn->error);
            return false; // Update failed
        }
    }

    // Helper method to get the existing photo path by client ID
    private function getPhotoPathById($id_client) {
        $stmt = $this->conn->prepare("SELECT foto FROM tb_client WHERE id_client = ?");
        $stmt->bind_param("i", $id_client);
        $stmt->execute();
        $stmt->bind_result($existingPhoto);
        
        // Fetch the result and close the statement
        $stmt->fetch();
        $stmt->close();

        // Check if the existing photo path is not empty and exists
        if (!empty($existingPhoto) && file_exists($existingPhoto)) {
            return $existingPhoto;
        } else {
            // Return a default path or handle accordingly based on your requirements
            return "default_path/default_photo.jpg";
        }
    }

    // Fungsi untuk menampilkan data tb_client berdasarkan id_client
    public function getClientById($id_client) {
        $stmt = $this->conn->prepare("SELECT id_client, nama_client, foto, link, keterangan FROM tb_client WHERE id_client = ?");
        $stmt->bind_param("i", $id_client);
        $stmt->execute();
        $stmt->bind_result($id_client, $nama_client, $foto, $link, $keterangan);
        $stmt->fetch();
        $stmt->close();
    
        if ($id_client !== null) {
            // Use the getPhotoPathById method to retrieve the correct photo path
            $fotoPath = $this->getPhotoPathById($id_client);
    
            return [
                'id_client' => $id_client,
                'nama_client' => $nama_client,
                'foto' => $fotoPath,
                'link' => $link,
                'keterangan' => $keterangan,
            ];
        } else {
            return null; // Client not found
        }
    }    

    // Fungsi untuk menghapus data tb_client
    public function deleteClient($id_client) {
        // First, retrieve the existing photo path
        $existingPhotoPath = $this->getPhotoPathById($id_client);
    
        // Then, delete the client record
        $stmt = $this->conn->prepare("DELETE FROM tb_client WHERE id_client = ?");
        $stmt->bind_param("i", $id_client);
        
        $success = $stmt->execute();
        
        $stmt->close();
    
        // If the delete operation is successful, delete the associated photo file
        if ($success) {
            if (!empty($existingPhotoPath) && file_exists($existingPhotoPath)) {
                unlink($existingPhotoPath);
            }
        }
    
        return $success;
    }
    

    // Fungsi untuk menampilkan data tb_partner
    public function getPartners() {
        // Retrieve all partner data from tb_partner
        $result = $this->conn->query("SELECT id_partner, nama_partner, foto, link, keterangan FROM tb_partner");

        $partnersData = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Assuming 'foto' column contains only the file name
                $row['imagePath'] = 'uploads/partner/' . $row['foto'];
                $partnersData[] = $row;
            }
        }

        return $partnersData;
    }

    // Fungsi untuk menambah data tb_partner
    public function addPartner($nama_partner, $foto, $link, $keterangan) {
        // File upload handling
        $targetDir = "uploads/partner/";
        $targetFile = $targetDir . basename($foto["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    
        // Check if file already exists
        if (file_exists($targetFile)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }
    
        // Check file size
        if ($foto["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
    
        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
    
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($foto["tmp_name"], $targetFile)) {
                echo "The file " . htmlspecialchars(basename($foto["name"])) . " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    
        // Insert data into tb_partner
        $stmt = $this->conn->prepare("INSERT INTO tb_partner (nama_partner, foto, link, keterangan) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nama_partner, $targetFile, $link, $keterangan);
    
        if ($stmt->execute()) {
            $stmt->close();
            return true; // Insertion successful
        } else {
            $stmt->close();
            echo "Error: " . $this->conn->error; // Display the SQL error for debugging purposes
            return false; // Insertion failed
        }
    }    

    // Fungsi untuk mengedit data tb_partner
    public function editPartner($id_partner, $nama_partner, $newFoto, $link, $keterangan) {
        // Check if a new photo is provided
        if (!empty($newFoto['name'])) {
            // File upload handling
            $targetDir = "uploads/partner/";
            $targetFile = $targetDir . basename($newFoto["name"]);

            // Move the uploaded file to the target location
            if (move_uploaded_file($newFoto["tmp_name"], $targetFile)) {
                echo "The file " . htmlspecialchars(basename($newFoto["name"])) . " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
                return false; // Upload failed
            }

            // Update data in tb_partner with the new photo path
            $stmt = $this->conn->prepare("UPDATE tb_partner SET nama_partner = ?, foto = ?, link = ?, keterangan = ? WHERE id_partner = ?");
            $stmt->bind_param("ssssi", $nama_partner, $targetFile, $link, $keterangan, $id_partner);
        } else {
            // No new photo provided, update without changing the photo path
            $stmt = $this->conn->prepare("UPDATE tb_partner SET nama_partner = ?, link = ?, keterangan = ? WHERE id_partner = ?");
            $stmt->bind_param("sssi", $nama_partner, $link, $keterangan, $id_partner);
        }

        // Execute the update query
        if ($stmt->execute()) {
            $stmt->close();
            return true; // Update successful
        } else {
            $stmt->close();
            echo "Error: " . $this->conn->error; // Display the SQL error for debugging purposes
            return false; // Update failed
        }
    }

    // Fungsi untuk mendapatkan data tb_partner berdasarkan id_partner
    public function getPartnerById($id_partner) {
        $stmt = $this->conn->prepare("SELECT id_partner, nama_partner, foto, link, keterangan FROM tb_partner WHERE id_partner = ?");
        $stmt->bind_param("i", $id_partner);
        $stmt->execute();
        $stmt->bind_result($id_partner, $nama_partner, $foto, $link, $keterangan);
        $stmt->fetch();
        $stmt->close();

        if ($id_partner !== null) {
            return [
                'id_partner' => $id_partner,
                'nama_partner' => $nama_partner,
                'foto' => $foto,
                'link' => $link,
                'keterangan' => $keterangan,
            ];
        } else {
            return null; // Partner not found
        }
    }

    // Fungsi untuk menghapus data tb_partner berdasarkan id_partner
    public function deletePartner($id_partner) {
        // First, get the existing photo path by partner ID
        $existingPhoto = $this->getPhotoPathById($id_partner);

        // Delete the record from tb_partner
        $stmt = $this->conn->prepare("DELETE FROM tb_partner WHERE id_partner = ?");
        $stmt->bind_param("i", $id_partner);

        if ($stmt->execute()) {
            $stmt->close();

            // Delete the photo file if it exists
            if ($existingPhoto !== null && file_exists($existingPhoto)) {
                unlink($existingPhoto);
            }

            return true; // Deletion successful
        } else {
            $stmt->close();
            echo "Error: " . $this->conn->error; // Display the SQL error for debugging purposes
            return false; // Deletion failed
        }
    }

    // Fungsi untuk menampilkan data tb_news
    public function getNews() {
        // Retrieve all news data from tb_news
        $result = $this->conn->query("SELECT id_news, judul_news, tanggal, foto, keterangan FROM tb_news");

        $newsData = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $newsData[] = $row;
            }
        }

        return $newsData;
    }

    // Fungsi untuk menambah data tb_news
    public function addNews($judul_news, $tanggal, $foto, $keterangan) {
        // File upload handling
        $targetDir = "uploads/news/";
        $targetFile = $targetDir . basename($foto["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Check if file already exists
        if (file_exists($targetFile)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Check file size
        if ($foto["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($foto["tmp_name"], $targetFile)) {
                echo "The file " . htmlspecialchars(basename($foto["name"])) . " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }

        // Insert data into tb_news
        $stmt = $this->conn->prepare("INSERT INTO tb_news (judul_news, tanggal, foto, keterangan) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $judul_news, $tanggal, $targetFile, $keterangan);

        if ($stmt->execute()) {
            $stmt->close();
            return true; // Insertion successful
        } else {
            $stmt->close();
            echo "Failed to add news.";
            return false; // Insertion failed
        }
    }

    // Fungsi untuk mengedit data tb_news
    public function editNews($id_news, $judul_news, $tanggal, $newFoto, $keterangan) {
        // Check if a new photo is provided
        if (!empty($newFoto['name'])) {
            // File upload handling (similar to the addNews method)
            $targetDir = "uploads/news/";
            $targetFile = $targetDir . basename($newFoto["name"]);
            move_uploaded_file($newFoto["tmp_name"], $targetFile);
        } else {
            // No new photo provided, use the existing photo path from the database
            $targetFile = $this->getPhotoPathByIdNews($id_news);
        }

        // Update data in tb_news
        $stmt = $this->conn->prepare("UPDATE tb_news SET judul_news = ?, tanggal = ?, foto = ?, keterangan = ? WHERE id_news = ?");
        $stmt->bind_param("ssssi", $judul_news, $tanggal, $targetFile, $keterangan, $id_news);

        if ($stmt->execute()) {
            $stmt->close();
            return true; // Update successful
        } else {
            $stmt->close();
            // Display the SQL error for debugging purposes
            die("Error: " . $this->conn->error);
            return false; // Update failed
        }
    }

    // Helper method to get the existing photo path by news ID
    private function getPhotoPathByIdNews($id_news) {
        $stmt = $this->conn->prepare("SELECT foto FROM tb_news WHERE id_news = ?");
        $stmt->bind_param("i", $id_news);
        $stmt->execute();
        $stmt->bind_result($existingPhoto);
        $stmt->fetch();
        $stmt->close();

        return $existingPhoto;
    }

    // Fungsi untuk mengambil data tb_news berdasarkan id_news
    public function getNewsById($id_news) {
        $stmt = $this->conn->prepare("SELECT id_news, judul_news, tanggal, foto, keterangan FROM tb_news WHERE id_news = ?");
        $stmt->bind_param("i", $id_news);
        $stmt->execute();
        $stmt->bind_result($id_news, $judul_news, $tanggal, $foto, $keterangan);
        $stmt->fetch();
        $stmt->close();

        if ($id_news !== null) {
            return [
                'id_news' => $id_news,
                'judul_news' => $judul_news,
                'tanggal' => $tanggal,
                'foto' => $foto,
                'keterangan' => $keterangan,
            ];
        } else {
            return null; // News not found
        }
    }

    public function deleteNews($id_news) {
        // Get the photo path before deletion
        $photoPath = $this->getPhotoPathByIdNews($id_news);

        // Prepare and execute the SQL query to delete the news
        $stmt = $this->conn->prepare("DELETE FROM tb_news WHERE id_news = ?");
        $stmt->bind_param("i", $id_news);

        $success = $stmt->execute();

        $stmt->close();

        // If the deletion was successful, also delete the associated photo file
        if ($success && !empty($photoPath) && file_exists($photoPath)) {
            unlink($photoPath);
        }

        return $success;
    }

    // Fungsi untuk menampilkan 3 data terbaru dari tb_news
    public function getNews3() {
        // Retrieve the latest 3 news data from tb_news
        $result = $this->conn->query("SELECT id_news, judul_news, tanggal, foto, keterangan FROM tb_news ORDER BY tanggal DESC LIMIT 3");

        $newsData = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $newsData[] = $row;
            }
        }

        return $newsData;
    }

    // Fungsi untuk menampilkan 2 data terbaru dari tb_news
    public function getNews2() {
        // Retrieve the latest 3 news data from tb_news
        $result = $this->conn->query("SELECT id_news, judul_news, tanggal, foto, keterangan FROM tb_news ORDER BY tanggal DESC LIMIT 2");

        $newsData = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $newsData[] = $row;
            }
        }

        return $newsData;
    }

    // Fungsi untuk menampilkan data tb_contact
    public function getContacts() {
        // Retrieve all contact data from tb_contact
        $result = $this->conn->query("SELECT id_contact, media, foto, contact, keterangan FROM tb_contact");

        $contactsData = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $contactsData[] = $row;
            }
        }

        return $contactsData;
    }

    // Fungsi untuk menambah data tb_contact
    public function addContact($media, $foto, $contact, $keterangan) {
        // File upload handling
        $targetDir = "uploads/contact/";
        $targetFile = $targetDir . basename($foto["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Check if file already exists
        if (file_exists($targetFile)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }
    
        // Check file size
        if ($foto["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
    
        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
    
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($foto["tmp_name"], $targetFile)) {
                echo "The file " . htmlspecialchars(basename($foto["name"])) . " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }

        // Insert data into tb_news
        $stmt = $this->conn->prepare("INSERT INTO tb_contact (media, foto, contact, keterangan) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $media, $targetFile, $contact, $keterangan);

        if ($stmt->execute()) {
            $stmt->close();
            return true; // Insertion successful
        } else {
            $stmt->close();
            echo "Failed to add news.";
            return false; // Insertion failed
        }
    }

    // Fungsi untuk mengedit data tb_contact
    public function editContact($id_contact, $media, $newFoto, $contact, $keterangan) {
        // Check if a new photo is provided
        if (!empty($newFoto['name'])) {
            // File upload handling (similar to the addContact method)
            $targetDir = "uploads/contact/";
            $targetFile = $targetDir . basename($newFoto["name"]);
            move_uploaded_file($newFoto["tmp_name"], $targetFile);
        } else {
            // No new photo provided, use the existing photo path from the database
            $targetFile = $this->getPhotoPathByIdContact($id_contact);
        }

        // Update data in tb_contact
        $stmt = $this->conn->prepare("UPDATE tb_contact SET media = ?, foto = ?, contact = ?, keterangan = ? WHERE id_contact = ?");
        $stmt->bind_param("ssssi", $media, $targetFile, $contact, $keterangan, $id_contact);

        if ($stmt->execute()) {
            $stmt->close();
            return true; // Update successful
        } else {
            $stmt->close();
            // Display the SQL error for debugging purposes
            die("Error: " . $this->conn->error);
            return false; // Update failed
        }
    }

    // Helper method to get the existing photo path by contact ID
    private function getPhotoPathByIdContact($id_contact) {
        $stmt = $this->conn->prepare("SELECT foto FROM tb_contact WHERE id_contact = ?");
        $stmt->bind_param("i", $id_contact);
        $stmt->execute();
        $stmt->bind_result($existingPhoto);
        $stmt->fetch();
        $stmt->close();

        // Ensure that $existingPhoto is initialized even if the condition is false
        if ($existingPhoto === null) {
            $existingPhoto = ''; // or any default value
        }

        return $existingPhoto;
    }

    // Fungsi untuk mendapatkan data tb_contact berdasarkan id_contact
    public function getContactById($id_contact) {
        $stmt = $this->conn->prepare("SELECT id_contact, media, foto, contact, keterangan FROM tb_contact WHERE id_contact = ?");
        $stmt->bind_param("i", $id_contact);
        $stmt->execute();
        $stmt->bind_result($id_contact, $media, $foto, $contact, $keterangan);
        $stmt->fetch();
        $stmt->close();
    
        if ($id_contact !== null) {
            return [
                'id_contact' => $id_contact,
                'media' => $media,
                'foto' => $foto,
                'contact' => $contact,
                'keterangan' => $keterangan,
            ];
        } else {
            return null; // Contact not found
        }
    }

    // Fungsi untuk menghapus data tb_contact
    public function deleteContact($id_contact) {
        // Get the existing photo path before deletion
        $existingPhoto = $this->getPhotoPathById($id_contact);

        // Delete the contact data from tb_contact
        $stmt = $this->conn->prepare("DELETE FROM tb_contact WHERE id_contact = ?");
        $stmt->bind_param("i", $id_contact);

        $result = $stmt->execute();
        $stmt->close();

        if ($result) {
            // Delete the photo file if it exists
            if (!empty($existingPhoto) && file_exists($existingPhoto)) {
                unlink($existingPhoto);
            }
            return true; // Deletion successful
        } else {
            return false; // Deletion failed
        }
    }

    // Fungsi untuk menampilka data tb_services (limit 3)
    public function getServicesData3() {
        try {
            // Menggunakan LIMIT untuk membatasi hasil hingga 4 data teratas
            $query = "SELECT id_services, nama_services, foto, keterangan FROM tb_services LIMIT 3";
            $result = $this->conn->query($query);
    
            // Check if the query was successful
            if ($result) {
                $servicesData = array();
    
                // Fetch the data as an associative array
                while ($row = $result->fetch_assoc()) {
                    $servicesData[] = $row;
                }
    
                return $servicesData;
            } else {
                echo "Error: " . $this->conn->error;
                return array(); // Mengembalikan array kosong jika terjadi kesalahan
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return array(); // Mengembalikan array kosong jika terjadi kesalahan
        }
    }

    // Fungsi untuk menampilka data tb_project (limit 3)
    public function getProjectsData3() {
        try {
            // Menggunakan LIMIT untuk membatasi hasil hingga 3 data teratas
            $query = "SELECT id_project, nama_project, foto, customer, lokasi, selesai, tipe_pekerjaan, keterangan FROM tb_project LIMIT 3";
            $result = $this->conn->query($query);
    
            // Check if the query was successful
            if ($result) {
                $projectsData = array();
    
                // Fetch the data as an associative array
                while ($row = $result->fetch_assoc()) {
                    $projectsData[] = $row;
                }
    
                return $projectsData;
            } else {
                echo "Error: " . $this->conn->error;
                return array(); // Mengembalikan array kosong jika terjadi kesalahan
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return array(); // Mengembalikan array kosong jika terjadi kesalahan
        }
    }
    
}

?>
