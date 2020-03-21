Installation
============

Make sure Composer is installed globally, as explained in the
[installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

Applications that use Symfony Flex
----------------------------------

Open a command console, enter your project directory and execute:

```console
$ composer require mluex/gravatar-bundle
```

Applications that don't use Symfony Flex
----------------------------------------

### Step 1: Download the Bundle

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```console
$ composer require mluex/gravatar-bundle
```

### Step 2: Enable the Bundle

Then, enable the bundle by adding it to the list of registered bundles
in the `config/bundles.php` file of your project:

```php
// config/bundles.php

return [
    // ...
    Mluex\GravatarBundle\MluexGravatarBundle::class => ['all' => true],
];
```

### Step 3: Configure Bundle

If you always have some default for your gravatars such as size, rating or default it can be configured in your config

  ```yaml
  # config/packages/mluex_gravatar.yml
  mluex_gravatar:
    rating: g
    size: 80
    default: mm
  ```

Usage
============

All you have to do is use the helper like this example:

```html
<img src="<?php echo $view['gravatar']->getUrl('alias@domain.tld') ?>" />
```

Or with parameters:

```html
<img src="<?php echo $view['gravatar']->getUrl('alias@domain.tld', '80', 'g', 'defaultimage.png', true) ?>" />
```

The only required parameter is the email adress. The rest have default values.

If you use twig you can use the helper like this example:

```
<img src="{{ gravatar('alias@domain.tld') }}" />
```

Or if you want to check if a gravatar email exists:

```
{% if gravatar_exists('alias@domain.tld') %}
  The email is an gravatar email
{% endif %}
```

Or with parameters:

```
<img src="{{ gravatar('alias@domain.tld', size, rating, default, secure) }}" />
```

For more information [look at the gravatar implementation pages][gravatar].

[gravatar]: http://en.gravatar.com/site/implement/
