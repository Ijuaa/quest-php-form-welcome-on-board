<?php
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $contact = array_map("trim", $_POST);
    if (empty($contact['userName'])) {
        $errors[] = 'Name is required';
    }
    if (empty($contact['userMail'])) {
        $errors[] = 'Email is required';
    } elseif (!filter_var($contact['userMail'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'L\'email n\'est pas valide';
    }

    if (empty($contact['subject'])) {
        $errors[] = 'Please choose a subject in the list.';
    }
    if (empty($errors)) {
        header('Location: validation.php');
        exit();
    }
    // if (empty($contact['message'])) {
    //     $errors[] = 'Please enter a message';
    // }
    // if (strlen($contact['message']) <= 10) {
    //     $errors[] = 'Your message must be at least 10 caracters long.';
    // }

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome on board</title>
    <link rel="stylesheet" href="/assets/styles/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Source+Sans+3:ital,wght@0,200..900;1,200..900&display=swap"
        rel="stylesheet">
</head>

<body>
    <header>
        <?php include '_navbar.php' ?>
        <div class="container">
            <h1>Welcome on board!</h1>
            <img src="/assets/images/avatar.png" alt="">
        </div>
    </header>
    <main>
        <section class="container">
            <h2 id="articles">Recent articles</h2>
            <div class="articles">
                <article>
                    <img src="/assets/images/responsive.png" alt="Responsive">
                    <h3>Responsive</h3>
                    <a href="#">Read</a>
                </article>
                <article>
                    <img src="/assets/images/scalable.png" alt="Scalable">
                    <h3>Scalable</h3>
                    <a href="#">Read</a>
                </article>
                <article>
                    <img src="/assets/images/inclusive.png" alt="Inclusive">
                    <h3>Inclusive</h3>
                    <a href="#">Read</a>
                </article>
            </div>
        </section>
        <section class="container">
            <h2 id="about">About</h2>
            <p>
                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Animi rerum debitis fugit similique laborum,
                eveniet nam ratione sed, itaque, minus in hic dolores suscipit molestias quis quibusdam error blanditiis
                sapiente.
                Laborum laudantium aut, consequuntur voluptatum animi eaque mollitia? Saepe neque facilis minima
                laborum, provident numquam ipsum laudantium totam porro placeat exercitationem voluptates quia explicabo
                temporibus sapiente non. Quo, repellat corrupti.
            </p>
            <p>
                Excepturi dolore saepe, temporibus est voluptate necessitatibus molestiae sit minima eum quisquam et qui
                quaerat nemo nam, consequuntur nisi alias in praesentium. Fuga amet esse nam doloremque ut nemo nostrum.
            </p>
        </section>
        <section class="formContainer container">
            <h2 id="contact">Get in touch</h2>
            <?php if (count($errors) > 0): ?>
                <h3>Please fix errors below</h3>
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?= $error ?></li>
                    <?php endforeach ?>
                </ul>
            <?php endif ?>
            <form id="contactForm" action="" method="post" novalidate>
                <label for="userName">Name <span class="required">*</span></label>
                <input required type="text" name="userName" id="userName" value="<?= $contact['userName'] ?? '' ?>">

                <label for="userMail">Email <span class="required">*</span></label>
                <input required type="email" name="userMail" id="userMail" value="<?= $contact['userMail'] ?? '' ?>">

                <label for="subject">Subject <span class="required">*</span></label>
                <select required name="subject" id="subject">
                    <option value="" disabled <?= empty($contact['subject']) ? 'selected' : '' ?>>Select a subject
                    </option>
                    <option value="rendez-vous" <?= (isset($contact['subject']) && $contact['subject'] === 'rendez-vous') ? 'selected' : '' ?>>Make an appointment</option>
                    <option value="newsletter" <?= (isset($contact['subject']) && $contact['subject'] === 'newsletter') ? 'selected' : '' ?>>Subscribe to the newsletter</option>
                    <option value="reclamation" <?= (isset($contact['subject']) && $contact['subject'] === 'reclamation') ? 'selected' : '' ?>>Reclamation</option>
                    <option value="quotation" <?= (isset($contact['subject']) && $contact['subject'] === 'quotation') ? 'selected' : '' ?>>Ask for a quotation</option>
                </select>


                <label for="userMessage">Message</label>
                <textarea name="userMessage" id="userMessage"
                    rows="5"><?= htmlspecialchars($contact['userMessage'] ?? '') ?></textarea>

            </form>
            <button class="formButton" form="contactForm">SEND</button>
        </section>
    </main>
    <?php include '_footer.php' ?>
</body>

</html>