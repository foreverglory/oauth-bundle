GloryOAuthBundle
======
composer require foreverglory/oauth-bundle

```php
//app/AppKernel.php
    public function registerBundles()
    {
        $bundles = array(
            // ...
            new Glory\Bundle\OAuthBundle\GloryOAuthBundle(),
            // ...
        );
    }
```
```yaml
#app/conﬁg/conﬁg.yml
glory_oauth:
    oauth_class: ~
    connect: ~
    owners:
        qq:
            type: qq
            client_id: %qq_id%
            client_secret: %qq_secret%
        # ...
```
```yaml
#app/config/routing.yml
glory_oauth:
    resource: "@GloryOAuthBundle/Resources/config/routing.yml"
    prefix:   /
```
```yaml
#app/config/security.yml
security:
    firewalls:
        main:
            oauth:
                login_path: /login
                check_path: /connect/{service}/callback 
                # or router name: glory_oauth_callback
```