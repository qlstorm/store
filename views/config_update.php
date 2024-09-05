<form action="/config">
    <p>
        <input name="host" value="<?= lib\Application::$conf['host'] ?>" disabled>
    </p>
    <p>
        <input name="login" value="<?= lib\Application::$conf['login'] ?>">
    </p>
    <p>
        <input name="password" value="<?= isset($_GET['password']) ? $_GET['password'] : '' ?>">
    </p>
    <p>
        <input name="database" value="<?= lib\Application::$conf['database'] ?>">
    </p>
    <p>
        <input type="submit">
    </p>
</form>