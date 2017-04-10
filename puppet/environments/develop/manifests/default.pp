Exec {
    path    => ["/usr/bin", "/bin", "/usr/sbin", "/sbin"],
    timeout => 0,
}

Package {
    require => Exec["apt-get : update"],
    before  => Exec["apt-get : autoremove"],
}

exec { "apt-get : update":
    command => "apt-get update",
}

exec { "apt-get : autoremove":
    command => "apt-get autoremove -q -y",
}

exec { "apt-get : https-update":
    command => "apt-get update",
}

package { "apt-get : https":
    name    => "apt-transport-https",
    require => Exec["apt-get : https-update"],
}

package { "vim":
    name => "vim",
}

package { "git":
    name => "git",
}

package { "unzip":
    name => "unzip",
}

exec { "php : key":
    creates => "/etc/apt/trusted.gpg.d/php.gpg",
    command => "wget -O /etc/apt/trusted.gpg.d/php.gpg https://packages.sury.org/php/apt.gpg",
}

file { "php : list":
    path    => "/etc/apt/sources.list.d/php.list",
    content => "deb https://packages.sury.org/php/ jessie main",
    require => Exec["php : key"],
    before  => Exec["apt-get : update"],
}

package { "php : cli":
    name => "php-cli",
    require => [
        File["php : list"],
        Exec["apt-get : update"],
    ],
}
