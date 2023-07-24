DigitalAustinSite
=================

Code running the Digital Austin Papers website

## Getting started on CentOS 7

I had to set this up on CentOS 7 because it's the only platform with PHP 5.4 that's still available on any major hosting service.

In writing this guide, I will assume that you're comfortable with Ubuntu but hearing the name "CentOS" has you like 🤯.

CentOS uses the `yum` package manager by default. For ease of use, you should start by upgrading to `dnf`, which is a lot more similar to `apt`. (`dnf` is the official replacement for `yum` in future Red Hat-related distributions).

1. `yum install dnf`
2. When the droplet is set up, go ahead and update everything with `dnf update && dnf upgrade`

DAP is a LAMP stack site, and [this article](https://web.archive.org/web/20230106195754/https://phoenixnap.com/kb/how-to-install-lamp-stack-on-centos) was perfect for getting Apache and friends up and running. You should be able to stop after the "Check whether PHP is working by visiting the following URL" step.

SELinux makes your system more secure, but it messes up the local file permissions for PHP in Apache. There's probably an official way to fix it, but for now let's disable SELinux by following [this article](https://web.archive.org/web/20230702115039/https://linuxize.com/post/how-to-disable-selinux-on-centos-7/).

Now you can copy the files from this repo to `/var/www/html`. (Hint: Clone the repo on your dev machine and ask Jamie for a [Transmit](https://panic.com/transmit/) key.)

You should be able to access the homepage by opening your server's IP address in your browser. If not, try rebooting or restarting Apache (`systemctl restart httpd`).
