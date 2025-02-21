<!doctype html>
<html lang="en">
<head>
    <style>
        .site-footer {
            background: black;
            padding: 60px 0;
            color: #fff;
            border-radius: 10px 10px 0 0;
            box-shadow: 0px -5px 20px rgba(0, 0, 0, 0.3);
        }

        .site-footer-title {
            font-weight: 700;
            font-size: 18px;
            margin-bottom: 15px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .footer-link {
            color: #ddd;
            text-decoration: none;
            font-size: 15px;
            transition: 0.3s;
        }

        .footer-link:hover {
            color: #ffcc00;
            text-decoration: underline;
        }
        .site-footer {
    position: relative;
    background: black;
    padding: 60px 0;
    color: #fff;
    border-radius: 10px 10px 0 0;
    box-shadow: 0px -5px 20px rgba(0, 0, 0, 0.3);
    overflow: hidden;
}

/* Upper left circle */
.site-footer::before,
.site-footer::after {
    content: "";
    position: absolute;
    width: 150px;
    height: 150px;
    background: radial-gradient(circle, rgba(255, 255, 255, 0.2), transparent);
    border-radius: 50%;
    z-index: 0;
}

/* Top left circle */
.site-footer::before {
    top: -50px;
    left: -50px;
}

/* Bottom right circle */
.site-footer::after {
    bottom: -50px;
    right: -50px;
}


    </style>
</head>
<body>
    <footer class="site-footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <h5 class="site-footer-title">Café Luxe</h5>
                    <p>Experience the finest coffee & moments.</p>
                </div>
                <div class="col-lg-3">
                    <h6 class="site-footer-title">Quick Links</h6>
                    <ul class="list-unstyled">
                        <li><a href="#" class="footer-link">Home</a></li>
                        <li><a href="#" class="footer-link">Menu</a></li>
                        <li><a href="#" class="footer-link">Contact</a></li>
                    </ul>
                </div>
                <div class="col-lg-3">
                    <h6 class="site-footer-title">Contact Us</h6>
                    <p><a href="tel:+3052409671" class="footer-link">+305-240-9671</a></p>
                    <p><a href="mailto:info@cafe.com" class="footer-link">info@cafe.com</a></p>
                </div>
                <div class="col-lg-3">
                    <p class="mt-4">© 2048 Café Luxe. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
