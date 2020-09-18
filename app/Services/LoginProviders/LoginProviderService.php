<?php


namespace App\Services\LoginProviders;

use App\Exceptions\InvalidLoginProviderException;
use App\Services\LoginProviders\Github\GithubCreator;
use App\Services\LoginProviders\Google\GoogleCreator;
use App\Services\LoginProviders\ProviderManager\ProviderManagerInterface;
use App\Services\LoginProviders\ProviderManager\SocialiteManager;

class LoginProviderService
{
    /**
     * @param string $providerName
     * @return LoginProvider
     * @throws \Exception
     */
    public function loginBy(string $providerName): LoginProvider
    {
        $providerCreator = $this->getProviderCreatorFor($providerName);

        return $this->getLoginProviderFor($providerCreator);
    }

    public function getLoginProviderFor(Creator $loginProvider): LoginProvider
    {
        return $loginProvider->createLoginProvider(
            $this->getProviderManager($loginProvider->getProviderName())
        );
    }

    /**
     * @param string $providerName
     * @return GoogleCreator
     * @throws \Exception
     */
    private function getProviderCreatorFor(string $providerName): Creator
    {
        switch ($providerName) {
            case 'google':
                $providerCreator = new GoogleCreator();
                break;
            case 'github':
                $providerCreator = new GithubCreator();
                break;
            default:
                throw new InvalidLoginProviderException('Unsupported Provider');
        }
        return $providerCreator;
    }

    /**
     * @param string $providerName
     * @return ProviderManagerInterface
     * @throws \Exception
     */
    public function getProviderManager(string $providerName): ProviderManagerInterface
    {
        $manager = new SocialiteManager();
        $creator = $this->getProviderCreatorFor($providerName);
        $provider = $creator->createLoginProvider($manager);
        $manager->setProvider($provider);

        return $manager;
    }
}
