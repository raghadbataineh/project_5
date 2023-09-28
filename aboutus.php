<?php 

include ('navbar.php');
include ('check_login.php');

?>
<head>
    <style>
        .about {
    padding: 130px 0;
}

.about .heading h2 {
    font-size: 30px;
    font-weight: 700;
    margin: 0;
    padding: 0;

}

.about .heading h2 span {
    color: #F24259;
}

.about .heading p {
    font-size: 15px;
    font-weight: 400;
    line-height: 1.7;
    color: #999999;
    margin: 20px 0 60px;
    padding: 0;
}

.about h3 {
    font-size: 25px;
    font-weight: 700;
    margin: 0;
    padding: 0;
}

.about p {
    font-size: 15px;
    font-weight: 400;
    line-height: 1.7;
    color: #999999;
    margin: 20px 0 15px;
    padding: 0;
}

.about h4 {
    font-size: 15px;
    font-weight: 500;
    margin: 8px 0;
}

.about h4 i {
    color: #F24259;
    margin-right: 10px;
}
    </style>
</head>
<section class="about" id="about">
            <div class="container">
                <div class="heading text-center">
                    <h2>About
                        <span>Us</span></h2>
                    <p>we are not just a retailer; we are the embodiment of a tech-driven vision.
                        <br>
                        we've evolved into a hub where cutting-edge technology meets personalized solutions.
                    </p>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <img src="https://images.unsplash.com/photo-1502982720700-bfff97f2ecac?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80" alt="about" class="img-fluid" width="100%">
                    </div>
                    <div class="col-lg-6">
                        <h3>Our mission is to simplify technology, making it accessible everyone.</h3>
                        <p>we're more than just a store; we're a community. We believe in fostering a space where tech enthusiasts, novices, and everyone in between can connect, learn, and share experiences</p>
                        <div class="row">
                            <div class="col-md-6">
                                <h4>
                                    <i class="far fa-star"></i>Honesty</h4>
                            </div>
                            <div class="col-md-6">
                                <h4>
                                    <i class="far fa-star"></i>
                                    Consistency</h4>
                            </div>
                            <div class="col-md-6">
                                <h4>
                                    <i class="far fa-star"></i>Better Client Service</h4>
                            </div>
                            <div class="col-md-6">
                                <h4>
                                    <i class="far fa-star"></i>
                                    Digital Marketing & Branding</h4>
                            </div>
                            <div class="col-md-6">
                                <h4>
                                    <i class="far fa-star"></i>Ethical</h4>
                            </div>
                            <div class="col-md-6">
                                <h4>
                                    <i class="far fa-star"></i>
                                    Speed And Flexibility</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>       
<?php 
	include ('footer.php');
?>