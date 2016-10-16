<?php
error_reporting(E_ERROR | E_PARSE);
$subjectPrefix = '[LeBlanc Contact Form]';
$emailTo = 'd.tarasov@kernel.ua';
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name    = stripslashes(trim($_POST['name']));
    $email   = stripslashes(trim($_POST['email']));
    $message = stripslashes(trim($_POST['message']));
    $pattern = '/[\r\n]|Content-Type:|Bcc:|Cc:/i';
    if (preg_match($pattern, $name) || preg_match($pattern, $email) || preg_match($pattern, $message)) {
        die("Header injection detected");
    }
    $emailIsValid = filter_var($email, FILTER_VALIDATE_EMAIL);
    if($name && $email && $emailIsValid && $message){
        $subject = "$subjectPrefix $subject";
        $body = "Имя: $name <br /> Email: $email <br /> Сообщение: $message";
        $headers  = "MIME-Version: 1.1" . PHP_EOL;
        $headers .= "Content-type: text/html; charset=utf-8" . PHP_EOL;
        $headers .= "Content-Transfer-Encoding: 8bit" . PHP_EOL;
        $headers .= "Date: " . date('r', $_SERVER['REQUEST_TIME']) . PHP_EOL;
        $headers .= "Message-ID: <" . $_SERVER['REQUEST_TIME'] . md5($_SERVER['REQUEST_TIME']) . '@' . $_SERVER['SERVER_NAME'] . '>' . PHP_EOL;
        $headers .= "From: " . "=?UTF-8?B?".base64_encode($name)."?=" . "<$email>" . PHP_EOL;
        $headers .= "Return-Path: $emailTo" . PHP_EOL;
        $headers .= "Reply-To: $email" . PHP_EOL;
        $headers .= "X-Mailer: PHP/". phpversion() . PHP_EOL;
        $headers .= "X-Originating-IP: " . $_SERVER['SERVER_ADDR'] . PHP_EOL;
        mail($emailTo, "=?utf-8?B?".base64_encode($subject)."?=", $body, $headers);
        $emailSent = true;
    } else {
        $hasError = true;
    }
}
?>
<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="css/normalize.min.css">
        <link rel="stylesheet" href="css/main.css">

        <script src="js/vendor/modernizr-2.8.3.min.js"></script>
    </head>
    <body>
        <?php if ($emailSent) : ?>
            <div class="message">Message was sent</div>
        <?php endif; ?>
        <?php if ($hasError) : ?>
            <div class="message error">Something wrong with the data you've provided</div>
        <?php endif; ?>
        <section class="section section__1">
            <div class="header">
                <img class="logo" src="img/logo.png" alt="Blanc" width="138">
                <img class="subheading" src="img/subheading.png" alt="Premium Sunflower Oil">

                <div class="nav-wrapper">
                <a href="#" class="toggle-nav">☰</a>
                    <ul class="nav">
                        <li><a href="#about">What is LeBlanc?</a></li>
                        <li><a href="#producing">How it is produced</a></li>
                        <li><a href="#perfection">Refined to perfection</a></li>
                        <li><a href="#vitamins">Vitamins</a></li>
                        <li><a href="#contacts">Contacts</a></li>
                    </ul>
                </div>

            </div>
            <div class="section__content"></div>
        </section>

        <div class="section section__2" id="about">
            <div class="caption__wrapper caption__wrapper-angled">
                <div class="caption caption-angled">
                    <h1>White is always<br>about the perfection</h1>
                    <p>All the perfect things in life are white — sun, white gold, bride's dress. You can't hide something with white , it emphases, makes visible, it accomplishes. White suits any other color, because it's all the colors together.</p>
                    <p>That's why finest quality cooking oil is called <strong>LeBlanc</strong></p>
                </div>
            </div>
        </div>

        <div class="section section__3" id="producing">
            <div class="caption">
                <h1>FINEST QUALITY OF FLAWLESS PURITY</h1>
                <p><strong>LeBlanc</strong> is all about the quality: we take only the highest quality sunflower seeds. Process them with the today’s most up-todate facilities and take control at every production stage.</p>
                <p>That’s why in the end we’ve got the flawless purity of LeBlanc.</p>
            </div>
        </div>

        <div class="section section__4" id="perfection">
            <div class="caption__wrapper caption__wrapper-angled">
                <div class="caption caption-angled">
                    <h1>Refined to Perfection</h1>
                    <p>Due to the modern refining technologies <strong>LeBlanc</strong> has no foreign taste or flavor so it emphasizes the uniqueness of your dishes and makes it taste the best</p>
                </div>
            </div>
        </div>

        <div class="section section__5">
            <div class="caption">
                <h1>Premium Quality dishes with premium quality oil</h1>
                <p>No matter whether your frying, stewing or baking <strong>Le Blanc</strong> guarantees maximum taste of your dishes with no foreign flavors</p>
            </div>
            <div class="caption-bottom" id="vitamins">
                <img src="img/section_5_img.png" alt="">
                <div class="caption">
                    <h1>Naturally enriched with vitamins A, B and E</h1>
                    <p>Special refining technology allows to preserve healthy elements and vitamins. <strong>LeBlanc</strong> is naturally enriched with vitamin E, so called «youth vitamin». It prevents aging and makes your skin smooth and young.</p>
                    <p>Vitamins B and A are vital for good metabolism and eyesight.</p>
                    <p>So in fact <strong>LeBlanc</strong> makes your dishes not only delicious but healthy as well.</p>
                </div>
            </div>
        </div>

        <div class="section section__6">
            <div class="caption">
                <p><strong>Le Blanc</strong> oil bottles are made of the highest quality plastics, which perfectly keep the shape. They are ergonomic,  easy to use and hold regardless of the volume of the bottle.</p>
            </div>
        </div>

        <div class="section section__footer" id="contacts">
            <div class="section__content">
                <img class="logo" src="img/logo_footer.png" alt="">

                <div class="footer__contacts">
                    <address>
                        3 Tarasa Shevchenka lane,<br>Kyiv, Ukraine, 01001
                    </address>
                    <p>(+38–044) 461–88–01</p>
                    <div class="contact">
                        <h3>Dinesh Kumar</h3>
                        <h4>Export manager</h4>
                        <a href="mailto:d.kumar@kernel.ua">d.kumar@kernel.ua</a>
                    </div>
                    <div class="contact">
                        <h3>Dmytro Tarasov</h3>
                        <h4>Head of export sales</h4>
                        <a href="mailto:d.tarasov@kernel.ua">d.tarasov@kernel.ua</a>
                    </div>
                    <a href="http://www.leblanc.life">http://www.leblanc.life</a>
                </div>

                <div class="footer__form">
                    <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
                        <div class="form__field">
                            <label for="name" class="form__label">
                                Your Name
                            </label>
                            <input type="text" name="name" id="name" class="form__input" placeholder="Name" required>
                        </div>
                        <div class="form__field">
                            <label for="email" class="form__label">
                                Your email
                            </label>
                            <input type="email" name="email" id="email" class="form__input" placeholder="Email" required>
                        </div>
                        <div class="form__field">
                            <label for="message" class="form__label">
                                Your message
                            </label>
                            <textarea name="message" id="message" cols="30" rows="10" class="form__textarea" placeholder="Message" required></textarea>
                        </div>
                        <button type="submit" class="form__button">Send</button>
                        <span class="form__notice">We will reply within 24 hours</span>
                    </form>
                </div>
            </div>
        </div>

        <script src="js/main.js"></script>
    </body>
</html>
