# Subscriber 

Consume and provide data in publish and subscribe manner:

```php
#[Singleton]
class AuthService
{
    private Subscriber $userSubscriber;
    private Subscription $userSubscription;

    public function usage()
    {
        // create
        $this->userSubscriber = new Subscriber();
        // publish value
        $this->userSubscriber->publish($this->userSession);
        // subscribe and consume
        $this->userSubscription = $this->userSubscriber->subscribe(
            function (UserSession $user) { 
                /** use it **/
                }
            );
        // unsubscribe once its done
        $this->userSubscription->unsubscribe();
    }

    // or use destroy hook to unsubscribe to avoid unnecessary actions in your component
    public function destroy()
    {
        $this->userSubscription->unsubscribe();
    }
//...
```