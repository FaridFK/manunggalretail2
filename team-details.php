<?php
// Include the DbConnector class
require_once 'admin/DbConnector.php';

// Create an instance of DbConnector
$dbConnector = new DbConnector();

$newsData2 = $dbConnector->getNews2();

// Mendapatkan data tb_project (limit 3)
$projectData = $dbConnector->getProjectsData3();

// Check if the ID is provided in the URL
if (isset($_GET['id'])) {
    // Get the member details by ID
    $memberId = $_GET['id'];
    $memberDetails = $dbConnector->getMemberById($memberId);

    // Check if member details are found
    if ($memberDetails) {
    } else {
        // Handle case where member details are not found
        echo 'Member not found.';
    }
} else {
    // Handle case where ID is not provided in the URL
    echo 'Invalid request.';
}

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
<mso:Order msdt:dt="string">170200.000000000</mso:Order>
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
            <div class="spinner">                
            </div>
                <div class="txt-loading">
                    <span data-text-preloader="T" class="letters-loading">
                        T
                    </span>
                    <span data-text-preloader="E" class="letters-loading">
                        E
                    </span>
                    <span data-text-preloader="C" class="letters-loading">
                        C
                    </span>
                    <span data-text-preloader="H" class="letters-loading">
                        H
                    </span>
                    <span data-text-preloader="E" class="letters-loading">
                        E
                    </span>
                    <span data-text-preloader="X" class="letters-loading">
                        X
                    </span>
                </div>
            <p class="text-center">Loading</p>
        </div>
        <div class="loader">
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
                                <h2>Team Details</h2>
                                <h3 class="fs-lg">Manunggal Group</h3>
                                <p>Home > Team > Team Details</p>
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

    <section class="team-member-wrapper section-padding">
        <div class="container">
            <div class="member-details-wrap">
                <div class="row justify-content-between">

                <div class="col-xl-4 col-12 col-lg-6">
                    <div class="member-card mr-0 mr-xl-3">
                        <div class="member-photo bg-cover" style="background-image: url('admin/<?php echo $memberDetails['foto']; ?>')"></div>
                        <div class="member-info">
                            <h4><?php echo $memberDetails['nama_member']; ?></h4>
                            <p><?php echo $memberDetails['nama_team']; ?></p>
                            <div class="social-link">
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-behance"></i></a>
                                <a href="#"><i class="fab fa-youtube"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 mt-5 col-lg-6 col-12 mt-lg-0">
                    <div class="member-about">
                        <div class="sec-title">
                            <h2>About Me</h2>
                        </div>
                        <p><?php echo $memberDetails['keterangan']; ?></p>

                        <div class="sec-title mt-4">
                            <h2>Contact Me</h2>
                        </div>

                        <div class="member-contact-info mt-4">
                            <div class="single-contact-info d-flex">
                                <div class="icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div class="contact-info">
                                    <p><?php echo $memberDetails['alamat']; ?></p>
                                </div>
                            </div>
                            <div class="single-contact-info d-flex">
                                <div class="icon">
                                    <i class="fas fa-envelope-open-text"></i>
                                </div>
                                <div class="contact-info">
                                    <p><?php echo $memberDetails['email']; ?></p>
                                </div>
                            </div>
                            <div class="single-contact-info d-flex">
                                <div class="icon">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <div class="contact-info">
                                    <p><?php echo $memberDetails['telepon']; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                    <div class="col-xl-4 mt-5 col-lg-12 col-12 mt-xl-0">
                        <div class="member-skills">
                            <div class="sec-title">
                                <h2>Skills</h2>
                            </div>
                            <p>Accusa ntium doloremque ntium totam rem aperiameaqueipsa quae  inventore veritatis quasi architect beatae</p>

                            <div class="single-skill-bar">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h4>Enterprise Solution</h4>
                                    <span>80%</span>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar" style="width: 80%"></div>
                                </div>
                            </div>
                            <div class="single-skill-bar">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h4>System Datacenter</h4>
                                    <span>85%</span>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar" style="width:85%"></div>
                                </div>
                            </div>
                            <div class="single-skill-bar">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h4>System Integrator</h4>
                                    <span>80%</span>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar" style="width:80%"></div>
                                </div>
                            </div>
                            <div class="single-skill-bar">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h4>IT Infrastructure</h4>
                                    <span>90%</span>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar" style="width:90%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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

    <footer class="footer-2 footer-wrap">
        <div class="footer-widgets">            
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-md-6 col-xl-3 col-12 pr-xl-4">
                        <div class="single-footer-wid site_footer_widget">
                            <a href="index.php">
                                <img src="assets/img/logo_manunggal.png" alt="">
                            </a>
                            <p class="mt-4">"Enterprise Solution dan Sistem Integrator"</p>
                            <div class="social-link mt-30">
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-behance"></i></a>
                                <a href="#"><i class="fab fa-youtube"></i></a>
                            </div>
                        </div>
                    </div> <!-- /.col-lg-3 - single-footer-wid -->
                    
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
                    © 2021 <a href="index.php">Techex</a>. All Rights Reserved
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