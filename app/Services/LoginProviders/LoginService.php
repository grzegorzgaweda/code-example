<?php


namespace App\Services\LoginProviders;


use App\Services\LoginProviders\Google\GoogleCreator;

class LoginService
{
    /**
     * @param string $providerName
     * @return LoginProvider
     * @throws \Exception
     */
    public function loginBy(string $providerName) : LoginProvider
    {
        $providerCreator = $this->getProviderCreatorFor($providerName);

        return $this->getLoginProviderFor($providerCreator);
    }

    public function getLoginProviderFor(Creator $loginProvider): LoginProvider
    {
        return $loginProvider->createLoginProvider();
    }

    /**
     * @param string $providerName
     * @return GoogleCreator
     * @throws \Exception
     */
    private function getProviderCreatorFor(string $providerName): GoogleCreator
    {
        switch ($providerName) {
            case 'google' :
                $providerCreator = new GoogleCreator();
                break;
            default:
                throw new \Exception('Unsupported Provider');
        }
        return $providerCreator;
    }

}
