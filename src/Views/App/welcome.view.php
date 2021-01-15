<!DOCTYPE html>
<html lang="en"> 
<head>
    <title>Showcase - Simple and powerful</title>
    
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <meta name="description" content="Bootstrap 4 Template For Software Startups">
    <meta name="author" content="Xiaoying Riley at 3rd Wave Media">    
    <link rel="shortcut icon" href="@{{images}}favicon.ico"> 
    
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700&display=swap" rel="stylesheet">
    
    <!-- FontAwesome JS-->
    <script defer src="@{{Assets}}/assets/fontawesome/js/all.min.js"></script>
    
    <!-- Plugins CSS -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.15.2/styles/atom-one-dark.min.css">

    <!-- Theme CSS -->  
    <link id="theme-style" rel="stylesheet" href="@{{Assets}}/assets/css/theme.css">

</head> 

<body class="docs-page">    
    <header class="header fixed-top">	    
        <div class="branding docs-branding">
            <div class="container-fluid position-relative py-2">
                <div class="docs-logo-wrapper">
					<button id="docs-sidebar-toggler" class="docs-sidebar-toggler docs-sidebar-visible mr-2 d-xl-none" type="button">
	                    <span></span>
	                    <span></span>
	                    <span></span>
	                </button>
	                <div class="site-logo"><a class="navbar-brand" href="/"><img class="logo-icon mr-2" src="@{{Assets}}assets/images/coderdocs-logo.svg" alt="logo"><span class="logo-text">Showcase<span class="text-alt">Docs</span></span></a></div>    
                </div><!--//docs-logo-wrapper-->
	            <div class="docs-top-utilities d-flex justify-content-end align-items-center">
	                <div class="top-search-box d-none d-lg-flex">
		                <form class="search-form">
				            <input type="text" placeholder="Search the docs..." name="search" class="form-control search-input">
				            <button type="submit" class="btn search-btn" value="Search"><i class="fas fa-search"></i></button>
				        </form>
	                </div>
	
					<ul class="social-list list-inline mx-md-3 mx-lg-5 mb-0 d-none d-lg-flex">
						<li class="list-inline-item"><a href="https://github.com/MohKamal/php-Showcase-template"><i class="fab fa-github fa-fw"></i></a></li>
			            <li class="list-inline-item"><a href="https://twitter.com/MOURCHIDKamal"><i class="fab fa-twitter fa-fw"></i></a></li>
		                <li class="list-inline-item"><a href="#"><i class="fab fa-slack fa-fw"></i></a></li>
		                <li class="list-inline-item"><a href="#"><i class="fab fa-product-hunt fa-fw"></i></a></li>
		            </ul><!--//social-list-->
		            <a href="https://github.com/MohKamal/php-Showcase-template" class="btn btn-primary d-none d-lg-flex">Download</a>
	            </div><!--//docs-top-utilities-->
            </div><!--//container-->
        </div><!--//branding-->
    </header><!--//header-->
    
    <div class="docs-wrapper">
	    <div id="docs-sidebar" class="docs-sidebar">
		    <div class="top-search-box d-lg-none p-3">
                <form class="search-form">
		            <input type="text" placeholder="Search the docs..." name="search" class="form-control search-input">
		            <button type="submit" class="btn search-btn" value="Search"><i class="fas fa-search"></i></button>
		        </form>
            </div>
		    <nav id="docs-nav" class="docs-nav navbar">
			    <ul class="section-items list-unstyled nav flex-column pb-3">
				    <li class="nav-item section-title"><a class="nav-link scrollto active" href="#section-1"><span class="theme-icon-holder mr-2"><i class="fas fa-map-signs"></i></span>Introduction</a></li>
				    <li class="nav-item section-title mt-3"><a class="nav-link scrollto" href="#section-2"><span class="theme-icon-holder mr-2"><i class="fas fa-arrow-down"></i></span>Installation</a></li>
				    <li class="nav-item section-title mt-3"><a class="nav-link scrollto" href="#section-3"><span class="theme-icon-holder mr-2"><i class="fas fa-box"></i></span>Routing</a></li>
				    <li class="nav-item"><a class="nav-link scrollto" href="#item-3-1">Routes</a></li>
				    <li class="nav-item"><a class="nav-link scrollto" href="#item-3-2">Response</a></li>
				    <li class="nav-item"><a class="nav-link scrollto" href="#item-3-3">Json resource</a></li>
				    <li class="nav-item section-title mt-3"><a class="nav-link scrollto" href="#section-4"><span class="theme-icon-holder mr-2"><i class="fas fa-cogs"></i></span>Database</a></li>
				    <li class="nav-item"><a class="nav-link scrollto" href="#item-4-0">Migration</a></li>
				    <li class="nav-item"><a class="nav-link scrollto" href="#item-4-1">Models</a></li>
				    <li class="nav-item"><a class="nav-link scrollto" href="#item-4-2">Controllers</a></li>
				    <li class="nav-item"><a class="nav-link scrollto" href="#item-4-3">Queries</a></li>
				    <li class="nav-item section-title mt-3"><a class="nav-link scrollto" href="#section-5"><span class="theme-icon-holder mr-2"><i class="fas fa-tools"></i></span>Security</a></li>
				    <li class="nav-item"><a class="nav-link scrollto" href="#item-5-1">Authentication</a></li>
				    <li class="nav-item"><a class="nav-link scrollto" href="#item-5-2">CSRF Guard</a></li>
				    <li class="nav-item"><a class="nav-link scrollto" href="#item-5-3">Validator</a></li>
				    <li class="nav-item section-title mt-3"><a class="nav-link scrollto" href="#section-6"><span class="theme-icon-holder mr-2"><i class="fas fa-laptop-code"></i></span>Views</a></li>
				    <li class="nav-item"><a class="nav-link scrollto" href="#item-6-1">Functions inside views</a></li>
				    <li class="nav-item"><a class="nav-link scrollto" href="#item-6-2">Variables from Controllers to View</a></li>
				    <li class="nav-item"><a class="nav-link scrollto" href="#item-6-3">Styles & Javascript & other Files</a></li>
				    <li class="nav-item section-title mt-3"><a class="nav-link scrollto" href="#section-7"><span class="theme-icon-holder mr-2"><i class="fas fa-tablet-alt"></i></span>Debug</a></li>
				    <li class="nav-item"><a class="nav-link scrollto" href="#item-7-1">File</a></li>
				    <li class="nav-item"><a class="nav-link scrollto" href="#item-7-2">Console</a></li>
				    <li class="nav-item section-title mt-3"><a class="nav-link scrollto" href="#section-8"><span class="theme-icon-holder mr-2"><i class="fas fa-book-reader"></i></span>Run It!</a></li>
			    </ul>

		    </nav><!--//docs-nav-->
	    </div><!--//docs-sidebar-->
	    <div class="docs-content">
		    <div class="container" id="main_wrapper">


			    <footer class="footer">
				    <div class="container text-center py-5">
					    <!--/* This template is free as long as you keep the footer attribution link. If you'd like to use the template without the attribution link, you can buy the commercial license via our website: themes.3rdwavemedia.com Thank you for your support. :) */-->
				        <small class="copyright">Designed with <i class="fas fa-heart" style="color: #fb866a;"></i> by <a class="theme-link" href="http://themes.3rdwavemedia.com" target="_blank">Xiaoying Riley</a> for developers</small>
				        <ul class="social-list list-unstyled pt-4 mb-0">
						    <li class="list-inline-item"><a href="https://github.com/MohKamal/php-Showcase-template"><i class="fab fa-github fa-fw"></i></a></li> 
				            <li class="list-inline-item"><a href="https://twitter.com/MOURCHIDKamal"><i class="fab fa-twitter fa-fw"></i></a></li>
				            <li class="list-inline-item"><a href="#"><i class="fab fa-slack fa-fw"></i></a></li>
				            <li class="list-inline-item"><a href="#"><i class="fab fa-product-hunt fa-fw"></i></a></li>
				            <li class="list-inline-item"><a href="#"><i class="fab fa-facebook-f fa-fw"></i></a></li>
				            <li class="list-inline-item"><a href="#"><i class="fab fa-instagram fa-fw"></i></a></li>
				        </ul><!--//social-list-->
				    </div>
			    </footer>
		    </div> 
	    </div>
    </div><!--//docs-wrapper-->
       
    <!-- Javascript -->          
    <script src="@{{Assets}}assets/plugins/jquery-3.4.1.min.js"></script>
    <script src="@{{Assets}}assets/plugins/popper.min.js"></script>
    <script src="@{{Assets}}assets/plugins/bootstrap/js/bootstrap.min.js"></script>  
    
    
    <!-- Page Specific JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.15.8/highlight.min.js"></script>
    <script src="@{{Assets}}assets/js/highlight-custom.js"></script> 
    <script src="@{{Assets}}assets/plugins/jquery.scrollTo.min.js"></script>
    <script src="@{{Assets}}assets/plugins/lightbox/dist/ekko-lightbox.min.js"></script> 
    <script src="@{{Assets}}assets/js/docs.js"></script> 

</body>
</html> 

