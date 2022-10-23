<p align="center">
  <img src="./art/logo.png" height="128" alt="" />
</p>
<h1 align="center">PalzinDumps</h1>
<div align="center">
  <br />
  <!--PalzinDumpsVersion-->
  <p align="center">
    <a href="https://github.com/palzindumps/app/releases/download/v1.4.0/PalzinDumps-Setup-1.4.0.exe">
      <img src="./art/os/windows.png" height="60" alt="PalzinDumps Windows App" />
    </a>
    <a href="https://github.com/palzindumps/app/releases/download/v1.4.0/PalzinDumps-1.4.0.dmg">
      <img src="./art/os/macos.png" height="60" alt="PalzinDumps MacOS App" />
    </a>
    <a href="https://github.com/palzindumps/app/releases/download/v1.4.0/PalzinDumps-1.4.0.AppImage">
      <img src="./art/os/linux.png" height="60" alt="PalzinDumps Linux App" />
    </a>
  </p>
  <!--EndOfPalzinDumpsVersion-->
  <h3>Click to Download the App</h3>
  <sub>Available for Windows, Linux and macOS.</sub>
  <br />
  <br />
  <p>
    <a href="https://docs.palzin.app/palzin-dumps/"> 📚 Documentation </a>
  </p>
</div>
 <br/>
<div align="center">
  <p align="center">
    <a href="https://packagist.org/packages/palzindumps/palzindumps">
      <img alt="Latest Version" src="https://img.shields.io/static/v1?label=laravel&message=%E2%89%A58.0&color=0078BE&logo=laravel&style=flat-square">
    </a>
    <a href="https://packagist.org/packages/palzindumps/palzindumps">
      <img alt="Total Downloads" src="https://img.shields.io/packagist/dt/palzindumps/palzindumps">
    </a>
    <a href="https://packagist.org/packages/palzindumps/palzindumps">
      <img alt="Latest Version" src="https://img.shields.io/packagist/v/palzindumps/palzindumps">
    </a>
    <a href="https://github.com/palzindumps/palzindumps/actions">
        <img alt="Tests" src="https://github.com/palzindumps/palzindumps/workflows/PalzinDumps%20Tests/badge.svg" />
    </a>
    <a href="https://packagist.org/packages/palzindumps/palzindumps">
      <img alt="License" src="https://img.shields.io/github/license/palzindumps/palzindumps">
    </a>
  </p>
</div>

### 👋 Hello Dev,

<br/>

PalzinDumps is a friendly app designed to boost your [Laravel](https://larvel.com/) PHP coding and debugging experience.

When using PalzinDumps, you can see the result of your debug displayed in a standalone Desktop application.

These are some debug tools available for you:

- [Dump](https://docs.palzin.app/palzin-dumps/laravel/debug/usage?id=dump) single or multiple variables at once.
- See your dumped values in a [Table](https://docs.palzin.app/palzin-dumps/laravel/debug/usage?id=table), with a built-in search feature.
- Improve your debugging experience using different [screens](https://docs.palzin.app/palzin-dumps/laravel/debug/usage?id=screens).
- Watch [SQL Queries](https://docs.palzin.app/palzin-dumps/laravel/debug/usage?id=sql-queries).
- Monitor [Laravel Logs](https://laravel.com/docs/9.x/logging).
- Validate [JSON strings](https://docs.palzin.app/palzin-dumps/laravel/debug/usage?id=json).
- Compare strings with [diff](https://docs.palzin.app/palzin-dumps/laravel/debug/usage?id=diff).
- Verify if a string [contains](https://docs.palzin.app/palzin-dumps/laravel/debug/usage?id=contains) a substring.
- View `phpinfo()` configuration.
- Debug [Livewire](https://laravel-livewire.com) Components & Events.
- List your [Laravel Routes](https://laravel.com/docs/9.x/routing).
- Inspect [Model](https://laravel.com/docs/9.x/eloquent) attributes.
- Learn more in our [Reference Sheet](https://docs.palzin.app/palzin-dumps/laravel/debug/reference-sheet).

<br/>
<table>
  <tr>
    <td>
      <p>🔥 Run <a href="https://docs.palzin.app/palzin-dumps/laravel/debug/deploying-to-production" target="_blank">artisan ds:check()</a> in your CI Pipeline to make sure there is no <a href="https://docs.palzin.app/palzin-dumps/laravel/debug/reference-sheet" target="_blank">ds()</a> shipped to Production.</p>
    </td>
  </tr>
</table>

<br>

### Get Started

#### Requirements

 PHP 8.0+ and Laravel 8.75+

#### Usage
<!--PalzinDumpsVersion-->
1. Download the 🖥️ [Palzin Dumps](https://palzin.app/palzin-dumps/) Desktop App here: [Windows](https://palzin.app/releases/download/v1.4.0/PalzinDumps-Setup-1.4.0.exe) | [MacOS](https://https://palzin.app/releases/download/v1.4.0/PalzinDumps-1.4.0.dmg)
 | [Linux](https://palzin.app/releases/download/v1.4.0/PalzinDumps-1.4.0.AppImage)
<!--EndOfPalzinDumpsVersion-->

2. Install PalzinDumps in your Laravel project, run:

```shell
 composer require palzin/palzin-dumps --dev
 ```

3. Configure PalzinDumps, run:

```shell
php artisan ds:init
 ```

4. Debug your code using `ds()` in the same way you would use Laravel's native functions dump() or dd().

5. Run your Laravel application and see the debug dump in PalzinDumps App window.

### Credits

PalzinDumps is a free open-source project, and it was inspired by [Spatie Ray](https://github.com/spatie/ray), check it out!

- Author: [Palzin Team](https://github.com/palzin)
