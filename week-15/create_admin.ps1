$process = Start-Process php -ArgumentList "artisan make:filament-user" -NoNewWindow -PassThru -WindowStyle Hidden
$process.StandardInput.WriteLine("admin user")
$process.StandardInput.WriteLine("admin@gmail.com")
$process.StandardInput.WriteLine("123456")
$process.StandardInput.WriteLine("123456")
$process.StandardInput.Close()
$process.WaitForExit()
