GravatarBundle
==============

**Deprecated**

[![Build Status](https://travis-ci.org/mluex/gravatar-bundle.svg?branch=master)](https://travis-ci.org/mluex/gravatar-bundle)

Installation
------------

  1. Add this bundle to your projects composer.json

  ```json
  "require": { 
      "mluex/gravatar-bundle" : "~1.0"
  }
  ```

  2. Run composer update to install the bundle and regenerate the autoloader
  
  ```bash
  $ composer update mluex/gravatar-bundle
  ```

  3. Add this bundle to your bundles.php:

  ```php
  // config/bundles.php
  return [
      // ...
      new Mluex\GravatarBundle\MluexGravatarBundle(),
      // ...
  ];
  ```

  4. If you always have some default for your gravatars such as size, rating or default it can be configured in your config

  ```yaml
  # config/packages/mluex_gravatar.yml
  mluex_gravatar:
    rating: g
    size: 80
    default: mm
  ```

Usage
-----

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
