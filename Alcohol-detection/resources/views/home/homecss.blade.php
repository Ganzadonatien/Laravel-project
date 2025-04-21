<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
<style>
    body {
        margin: 0;
        font-family: 'Roboto', sans-serif;
        background: #fff;
        color: #000;
        text-align: center;
    }

    nav {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px 50px;
    }

    nav ul {
        list-style: none;
        display: flex;
        gap: 30px;
    }

    nav ul li {
        display: inline;
        font-weight: 500;
        cursor: pointer;
    }

    nav ul li.active {
        font-weight: bold;
    }

    .logo {
        font-weight: bold;
        font-size: 20px;
    }

    .container {
        margin-top: 60px;
    }

    .icon {
        font-size: 100px;
        color: blue;
        margin-bottom: 20px;
    }

    .welcome {
        font-size: 28px;
        color: blue;
    }

    .description {
        margin-top: 20px;
        font-size: 14px;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }

    .buttons {
        margin-top: 40px;
        display: flex;
        justify-content: center;
        gap: 20px;
    }

    .btn {
        padding: 10px 30px;
        border-radius: 20px;
        border: none;
        cursor: pointer;
        font-size: 16px;
    }

    .btn-login {
        background-color: #007bff;
        color: white;
    }

    .btn-signup {
        background-color: #cfdfff;
        color: #007bff;
    }

    .small-text {
        font-size: 12px;
        color: blue;
        margin-top: 5px;
    }
</style>
