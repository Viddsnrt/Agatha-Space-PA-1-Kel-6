<footer class="footer-coffee text-white mt-5">
    <div class="container py-5">
        <div class="row">
            <!-- Logo and About -->
            <div class="col-md-4 mb-4">
                <h2 class="logo-font">Agatha Space</h2>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                <div class="social-icons mt-3">
                    <a href="#"><i class="bi bi-facebook"></i></a>
                    <a href="#"><i class="bi bi-instagram"></i></a>
                    <a href="#"><i class="bi bi-youtube"></i></a>
                    <a href="#"><i class="bi bi-twitter"></i></a>
                </div>
            </div>

            <!-- About Links -->
            <div class="col-md-2 mb-4">
                <h5>About</h5>
                <ul class="list-unstyled">
                    <li><a href="#">Menu</a></li>
                    <li><a href="#">Features</a></li>
                    <li><a href="#">News & Blogs</a></li>
                    <li><a href="#">Help & Supports</a></li>
                </ul>
            </div>

            <!-- Company Links -->
            <div class="col-md-2 mb-4">
                <h5>Company</h5>
                <ul class="list-unstyled">
                    <li><a href="#">How we work</a></li>
                    <li><a href="#">Terms of service</a></li>
                    <li><a href="#">Pricing</a></li>
                    <li><a href="#">FAQ</a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div class="col-md-4 mb-4">
                <h5>Contact Us</h5>
                <p>Akshya Nagar 1st Block 1st Cross, Ramamurthy nagar, Bangalore-560016</p>
                <p>082349689976</p>
                <p>agathaspace@gmail.com</p>
                <p>www.agathaspace.com</p>
            </div>
        </div>
    </div>
</footer>
<style>
    .footer-coffee {
        background: linear-gradient(rgba(58, 29, 0, 0.9), rgba(58, 29, 0, 0.9)), url('{{ asset('images/coffeebeans.jpg') }}') no-repeat center bottom;
        background-size: cover;
        color: #fff;
        font-family: 'Poppins', sans-serif;
    }

    .footer-coffee h2.logo-font {
        font-family: 'Dancing Script', cursive;
        font-size: 2rem;
    }

    .footer-coffee ul li a {
        color: #ffffffcc;
        text-decoration: none;
    }

    .footer-coffee ul li a:hover {
        text-decoration: underline;
        color: #fff;
    }

    .footer-coffee .social-icons a {
        color: white;
        font-size: 1.2rem;
        margin-right: 10px;
    }

    .footer-coffee .social-icons a:hover {
        color: #d1a46f;
    }
</style>