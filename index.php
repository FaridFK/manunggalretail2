<?php
// Menggunakan DbConnector.php
require_once 'admin/DbConnector.php';

// Membuat objek DbConnector
$dbConnector = new DbConnector();

// Mendapatkan koneksi
$dbConnection = $dbConnector->getConnection();

// Menggunakan fungsi getServicesData() untuk mendapatkan data tb_services
$servicesData = $dbConnector->getServicesData3();

// Mendapatkan data tb_project (limit 3)
$projectData = $dbConnector->getProjectsData3();

// Mendapatkan data tb_client
$clientData = $dbConnector->getClients();

// Get recent news data
$recentNewsData = $dbConnector->getNews3();

$newsData2 = $dbConnector->getNews2();

// Get the contact data
$contactsData = $dbConnector->getContacts();
?>

<!DOCTYPE html>
<html lang="en" xmlns:mso="urn:schemas-microsoft-com:office:office" xmlns:msdt="uuid:C2F41010-65B3-11d1-A29F-00AA00C14882">

<head>
    <!-- ========== Meta Tags ========== -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="modinatheme">
    <!-- ======== Page title ============ -->
    <title>Enterprise Solution dan Sistem Integrator</title>
    <!-- ========== Favicon Icon ========== -->
    <link rel="shortcut icon" href="assets/img/logo_1.png">
    <!-- ===========  All Stylesheet ================= -->
    <!--  Icon css plugins -->
    <link rel="stylesheet" href="assets/css/icons.css">
    <!--  animate css plugins -->
    <link rel="stylesheet" href="assets/css/animate.css">
    <!--  magnific-popup css plugins -->
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <!--  owl carosuel css plugins -->
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <!-- metis menu css file -->
    <link rel="stylesheet" href="assets/css/metismenu.css">
    <!--  owl theme css plugins -->
    <link rel="stylesheet" href="assets/css/owl.theme.css">
    <!--  Bootstrap css plugins -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!--  main style css file -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- template main style css file -->
    <link rel="stylesheet" href="style.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

<!--[if gte mso 9]><xml>
<mso:CustomDocumentProperties>
<mso:xd_Signature msdt:dt="string"></mso:xd_Signature>
<mso:display_urn_x003a_schemas-microsoft-com_x003a_office_x003a_office_x0023_Editor msdt:dt="string">Ariandi Prayogo</mso:display_urn_x003a_schemas-microsoft-com_x003a_office_x003a_office_x0023_Editor>
<mso:Order msdt:dt="string">168600.000000000</mso:Order>
<mso:xd_ProgID msdt:dt="string"></mso:xd_ProgID>
<mso:_ExtendedDescription msdt:dt="string"></mso:_ExtendedDescription>
<mso:display_urn_x003a_schemas-microsoft-com_x003a_office_x003a_office_x0023_Author msdt:dt="string">Ariandi Prayogo</mso:display_urn_x003a_schemas-microsoft-com_x003a_office_x003a_office_x0023_Author>
<mso:ComplianceAssetId msdt:dt="string"></mso:ComplianceAssetId>
<mso:TemplateUrl msdt:dt="string"></mso:TemplateUrl>
<mso:ContentTypeId msdt:dt="string">0x010100F297298F565D9E49AA97496C67E18694</mso:ContentTypeId>
<mso:TriggerFlowInfo msdt:dt="string"></mso:TriggerFlowInfo>
<mso:_SourceUrl msdt:dt="string"></mso:_SourceUrl>
<mso:_SharedFileIndex msdt:dt="string"></mso:_SharedFileIndex>
<mso:TaxCatchAll msdt:dt="string"></mso:TaxCatchAll>
<mso:MediaServiceImageTags msdt:dt="string"></mso:MediaServiceImageTags>
<mso:lcf76f155ced4ddcb4097134ff3c332f msdt:dt="string"></mso:lcf76f155ced4ddcb4097134ff3c332f>
</mso:CustomDocumentProperties>
</xml><![endif]-->
</head>

<body class="body-wrapper">    
    
    <!-- preloader -->
    <div id="preloader" class="preloader">
        <div class="animation-preloader">
            <!-- Replace the spinner with the logo image -->
            <div class="logo-container">
                <img src="assets/img/logo_manunggal.png" alt="Logo Manunggal">
            </div>
            <div class="txt-loading">
                <!-- Your text loading animation remains unchanged -->
                <span data-text-preloader="M" class="letters-loading">M</span>
                <span data-text-preloader="A" class="letters-loading">A</span>
                <span data-text-preloader="N" class="letters-loading">N</span>
                <span data-text-preloader="U" class="letters-loading">U</span>
                <span data-text-preloader="N" class="letters-loading">N</span>
                <span data-text-preloader="G" class="letters-loading">G</span>
                <span data-text-preloader="G" class="letters-loading">G</span>
                <span data-text-preloader="A" class="letters-loading">A</span>
                <span data-text-preloader="L" class="letters-loading">L</span>
            </div>
            <p class="text-center">Loading</p>
        </div>
        <div class="loader">
            <!-- Your loader sections remain unchanged -->
            <div class="row">
                <div class="col-3 loader-section section-left">
                    <div class="bg"></div>
                </div>
                <div class="col-3 loader-section section-left">
                    <div class="bg"></div>
                </div>
                <div class="col-3 loader-section section-right">
                    <div class="bg"></div>
                </div>
                <div class="col-3 loader-section section-right">
                    <div class="bg"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- welcome content start from here -->

    <header class="header-wrap header-1">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-6 col-sm-5 col-xl-2">
                    <div class="logo">
                        <a href="index.php">
                            <img src="assets/img/logo_manunggal.png" alt="logo">
                        </a>
                    </div>
                </div>
                <div class="col-xl-7 d-none d-xl-block">
                    <div class="main-menu">
                        <ul>
                            <li><a href="index.php">Home</a> </li>
                            <li><a href="about.php">About</a> </li>
                            <li><a href="services.php">Services</a></li>
                            <li><a href="project.php">Project</a> </li>
                            <li><a href="team.php">Team</a> </li>
                            <li><a href="news.php">News</a></li>
                            <li><a href="contact.php">Contact</a></li>
                        </ul>
                    </div>
                </div>
                <!-- <div class="col-xl-3 col-sm-6 d-none d-sm-block pl-xl-0 text-right">
                    <a href="contact.html" class="theme-btn">Consultancy <i class="fas fa-arrow-right"></i></a>
                </div> -->
                <div class="mobile-nav-bar d-block col-sm-1 col-6 d-xl-none">
                    <div class="mobile-nav-wrap">                    
                        <div id="hamburger">
                            <i class="fal fa-bars"></i>
                        </div>
                        <!-- mobile menu - responsive menu  -->
                        <div class="mobile-nav">
                            <button type="button" class="close-nav">
                                <i class="fal fa-times-circle"></i>
                            </button>
                            <nav class="sidebar-nav">
                                <ul class="metismenu" id="mobile-menu">
                                    <li><a href="index.php">Home</a></li>
                                    <li><a href="about.php">about</a></li>
                                    <li><a href="services.php">services</a></li>
                                    <li>
                                        <a class="has-arrow" href="#">Pages</a>
                                        <ul class="sub-menu">
                                            <li><a href="faq.html">faq</a></li>
                                            <li><a href="services-details.php">services details</a></li>
                                            <li><a href="team.php">Team</a></li>
                                            <li><a href="cases-grid.html">Case Grid</a></li>
                                            <li><a href="case-2.html">Case Grid 2</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="news.php">News</a></li>
                                    <li><a href="contact.php">Contact</a></li>
                                </ul>
                            </nav>

                            <div class="action-bar">
                                <a href="mailto:modinatheme@gmail.com"><i class="fal fa-envelope-open-text"></i>info@webmail.com</a>
                                <a href="tel:123-456-7890"><i class="fal fa-phone"></i>987-098-098-09</a>
                                <!-- <a href="contact.html" class="d-btn theme-btn black">Consultancy</a> -->
                            </div>
                        </div>                            
                    </div>
                    <div class="overlay"></div>
                </div>
            </div>
        </div>
    </header>

    <section class="hero-slide-wrapper hero-1">
        <div class="hero-slider-active owl-carousel">
            <div class="single-slide bg-cover">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-xl-8 col-lg-10">
                            <div class="hero-contents">
                                <!-- <h2>Welcome</h2> -->
                                <h2 class="fs-lg">Manunggal Integrasi Sejahtera</h2>
                                <p>Enterprise Solution dan Sistem Integrator</p>
                                <!-- <a href="services.html" class="theme-btn">Service we provide <i class="fas fa-arrow-right"></i></a>
                                <a href="about.html" class="theme-btn minimal-btn">learn more <i class="fas fa-arrow-right"></i></a> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="slide-top-img d-none d-lg-block bg-overlay bg-cover" style="background-image: url('assets/img/home1/teknologi1.jpg')"></div>
                <div class="slide-bottom-img d-none d-xl-block bg-overlay bg-cover" style="background-image: url('assets/img/home1/teknologi1.jpg')"></div>
            </div>
        </div>
    </section>

    <section class="features-wrapper features-1 section-padding pb-0">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-12">
                    <div class="section-title text-center">
                        <p>How can help you</p>
                        <h1>We Help Your IT Business</h1>
                    </div>
                </div>
            </div>

            <div class="row mt-3 mt-lg-5">
                <div class="col-xl-4 d-none d-xl-block">
                    <div class="features-banner mt-30 bg-cover" style="background-image: url('assets/img/home1/s3.jpg')">
                    </div>
                </div>
                <div class="col-xl-8 col-12">
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="single-features-item">
                                <div class="icon">
                                    <i class="flaticon-speech-bubble"></i>
                                </div>
                                <div class="content">
                                    <h3>Enterprise Solution</h3>
                                    <!-- <p>Integrate Multiple Facets Of A Company Bussiness</p> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="single-features-item">
                                <div class="icon">
                                    <i class="flaticon-unlock"></i>
                                </div>
                                <div class="content">
                                    <h3>System Datacenter</h3>
                                    <!-- <p>Installing Maintaining Network Resources & Monitoring Systems</p> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="single-features-item">
                                <div class="icon">
                                    <i class="flaticon-user"></i>
                                </div>
                                <div class="content">
                                    <h3>System Integrator</h3>
                                    <!-- <p>Specializes In Bringing Together Component Subsystems Into A Whole</p> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="single-features-item">
                                <div class="icon">
                                    <i class="flaticon-monitor"></i>
                                </div>
                                <div class="content">
                                    <h3>IT Infrastructure</h3>
                                    <!-- <p>Deliver IT Services To End-User</p> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="feature-cta bg-cover bg-center text-white" style="background-image: url('assets/img/home1/wave.png')">
                                <p>Perusahaan kami berdedikasi untuk menyediakan solusi terintegrasi yang komprehensif bagi bisnis Anda. 
                                    Dengan spesialisasi dalam penggabungan berbagai aspek bisnis perusahaan, 
                                    kami memiliki keahlian dalam menyatukan subsistem komponen menjadi satu kesatuan yang efisien. 
                                    Kami tidak hanya menginstal, tetapi juga melakukan pemeliharaan sumber daya jaringan dan sistem pemantauan secara profesional. 
                                    Melalui pendekatan ini, kami bertujuan untuk memberikan layanan IT yang optimal kepada pengguna akhir, 
                                    menjadikan perusahaan Anda siap menghadapi tantangan teknologi masa depan.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="about-us-wrapper section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-12 pr-lg-5 order-2 order-lg-1 mt-5 mt-lg-0">
                    <div class="section-title mb-30">
                        <p>About Company</p>
                        <h1>Profil Kami</h1>
                    </div>

                    <p class="pr-5">Manunggal Integrasi Sejahtera adalah sebuah perusahaaan yang bergerak di bidang teknologi informasi terutama sebagai 
                        "Enterprise Solution dan Sistem Integrator". Customer kami terdiri dari korporasi, pemerintahan maupun perorangan.<br>
                        <br>Kami memiliki staf yang berpengalaman dalam bidang teknologi, memiliki sertifikat keahlian dari Global Partners kami, 
                        menjadi salah satu perusahaan yang memiliki serfikat keahlian dari VMware untuk kategori virtualisasi data center. 
                        Memiliki sertifikat keahlian dari Badan Nasional Sertifikasi Profesi (BNSP) dibidang Management Data Center.</p><br>
                        <a href="about.php" class="theme-btn minimal-btn">read more <i class="fas fa-arrow-right"></i></a>
                </div>

                <div class="col-lg-6 pl-lg-5 col-12 order-1 order-lg-2">
                    <span class="dot-circle"></span>
                    <div class="about-us-img" style="background-image: url('assets/img/kantor.png')">
                    </div>
                    <span class="triangle-bottom-right"></span>
                </div>
            </div>
        </div>
    </section>  

    <section class="services-wrapper service-1 section-padding section-bg">
        <div class="container">
            <div class="row mb-4 mb-lg-5">
                <div class="col-12 col-lg-12">
                    <div class="section-title text-white text-center">
                        <h1>Our Professional Solutions <br>
                            For IT Business</h1>
                    </div>
                </div>
            </div>

            <div class="row">
                <?php
                // Menampilkan hasil kueri
                foreach ($servicesData as $service) {
                    echo '<div class="col-md-4 col-12">';
                    echo '<div class="single-service-item">';
                    echo '<div class="icon">';
                    echo '<img src="admin/' . $service['foto'] . '" alt="service">';
                    echo '</div>';
                    echo '<h4>' . $service['nama_services'] . '</h4>';
                    echo '<a href="services-details.php">learn more <i class="fas fa-arrow-right"></i></a>';
                    echo '</div>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </section> 

    <section class="case-study-wrapper section-padding">
        <div class="container">
            <div class="row mb-50 align-items-center">
                <div class="col-12 col-md-5">
                    <div class="section-title">
                        <p>our Recent project</p>
                        <h1>Latest Case Studies</h1>
                    </div>
                </div>
            </div>
            
            <div class="row grid">
                <?php
                // Assuming $projectData contains the result of getProjects() function
                foreach ($projectData as $project) :
                ?>
                    <div class="col-xl-4 col-md-6 grid-item <?php echo $project['tipe_pekerjaan']; ?>">
                        <div class="single-case-study">
                            <div class="features-thumb bg-cover" style="background-image: url('admin/<?php echo $project['foto']; ?>')"></div>
                            <div class="content">
                                <h3><?php echo $project['nama_project']; ?></h3>
                                <p><?php echo $project['customer']; ?></p>
                                <p><?php echo $project['selesai']; ?></p>
                                <a href="project-details.php">Read more <i class="fas fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="services-wrapper service-1 section-padding section-bg">
        <div class="container">
            <div class="row mb-4 mb-lg-5">
                <div class="col-12 col-lg-12">
                    <div class="section-title text-white text-center">
                        <h1>Our Client</h1>
                    </div>
                </div>
            </div>

            <div class="row">
                <?php
                // Menampilkan hasil kueri
                foreach ($clientData as $client) {
                    echo '<div class="col-md-6 col-xl-3 col-12">';
                    echo '<div class="single-service-item">';
                    echo '<div class="icon">';
                    echo '<img src="admin/' . $client['foto'] . '" alt="client" width="150">';
                    echo '</div>';
                    echo '<h4>' . $client['nama_client'] . '</h4>';
                    echo '<a href="' . $client['link'] . '">go to <i class="fas fa-arrow-right"></i></a>';
                    echo '</div>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </section>

    <section class="blog-section section-padding bg-contain" style="background-image: url('assets/img/blog_bg.png')">
        <div class="container">
            <div class="row mb-30">
                <div class="col-12 col-lg-12">
                    <div class="section-title text-center">
                        <p>Latest News & Blog</p>
                        <h1>Get Every Single Updates</h1>
                    </div>
                </div>
            </div>

            <div class="row">
                <?php foreach ($recentNewsData as $news): ?>
                    <div class="col-xl-4 col-md-6 col-12">
                        <div class="single-blog-card">
                            <div class="blog-featured-thumb bg-cover" style="background-image: url('<?php echo "admin/pages/". $news['foto']; ?>')"></div>
                            <div class="content">
                                <div class="post-author">
                                    <a href="news-details.php"><i class="far fa-calendar-alt"></i> <?php echo $news['tanggal']; ?></a>
                                </div>
                                <h3><a href="news-details.php"><?php echo $news['judul_news']; ?></a></h3>
                                <div class="btn-link-share">
                                    <a href="news-details.php" class="theme-btn minimal-btn">read more <i class="fas fa-arrow-right"></i></a>
                                    <a href="#"><i class="fal fa-share-alt"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <footer class="footer-1 footer-wrap">
        <div class="footer-widgets">            
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-md-6 col-xl-3 col-12 pr-xl-4">
                        <div class="single-footer-wid site_footer_widget newsletter_widget">
                            <a href="index.php">
                                <img src="assets/img/logo_manunggal.png" alt="">
                            </a>
                            <p class="mt-4">"Enterprise Solution dan Sistem Integrator"</p>
                            <div class="newsletter_box">
                                <form action="#">
                                    <input type="email" placeholder="Email address" required>
                                    <button class="submit-btn" type="submit"><i class="fal fa-envelope-open-text"></i></button>
                                </form>
                            </div>
                        </div>
                    </div> <!-- /.col-lg-3 - single-footer-wid -->
                    
                    <!-- /.col-lg-3 - single-footer-wid -->
                    <div class="col-md-6 col-xl-3 col-12">
                        <div class="single-footer-wid recent_post_widget">
                            <div class="wid-title">
                                <h4>News</h4>
                            </div>
                            <div class="recent-post-list">
                                <?php
                                // Assuming $recentPosts is an array containing recent posts data
                                foreach ($newsData2 as $news) {
                                    echo '<div class="single-recent-post">';
                                    echo '<div class="thumb bg-cover" style="background-image: url(\'admin/' . $news['foto'] . '\');"></div>';
                                    echo '<div class="post-data">';
                                    echo '<span><i class="fal fa-calendar-alt"></i>' . $news['tanggal'] . '</span>';
                                    echo '<h5><a href="news-details.php?id=' . $news['id_news'] . '">' . $news['judul_news'] . '</a></h5>';
                                    echo '</div>';
                                    echo '</div>';
                                }
                                ?>
                            </div>
                        </div>
                    </div> <!-- /.col-lg-3 - single-footer-wid -->
                    <div class="col-md-6 col-xl-3 col-12">                        
                        <div class="single-footer-wid contact_widget_2">
                            <div class="wid-title">
                                <h4>Contact Us</h4>
                            </div>
                            <div class="contact-us">
                                <?php
                                // Assuming $contactsData is an array containing contact data
                                foreach ($contactsData as $contact) :
                                ?>
                                    <div class="single-contact-info">
                                        <div class="icon">
                                            <img src="admin/<?php echo $contact['foto']; ?>" alt="Contact Icon" width="35">
                                        </div>

                                        <div class="contact-info">
                                            <p><?php echo $contact['contact']; ?></p>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div> <!-- /.col-lg-3 - single-footer-wid -->
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="container text-center">
                <div class="footer-bottom-content">
                    © 2021 Techex All Rights Reserved, Share By <a href="https://nullphpscript.com/category/html/">HTML Templates</a>
                </div>
            </div>
        </div>
    </footer>

    <!--  ALl JS Plugins
    ====================================== -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/modernizr.min.js"></script>
    <script src="assets/js/jquery.easing.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/isotope.pkgd.min.js"></script>
    <script src="assets/js/imageload.min.js"></script>
    <script src="assets/js/scrollUp.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/magnific-popup.min.js"></script>
    <script src="assets/js/waypoint.js"></script>
    <script src="assets/js/easypiechart.min.js"></script>
    <script src="assets/js/counterup.min.js"></script>
    <script src="assets/js/wow.min.js"></script>
    <script src="assets/js/metismenu.js"></script>
    <script src="assets/js/timeline.min.js"></script>
    <script src="assets/js/ajax-mail.js"></script>
    <script src="assets/js/active.js"></script>
</body>

</html>