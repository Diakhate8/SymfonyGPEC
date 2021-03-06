<?php

namespace Proxies\__CG__\App\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class Contrat extends \App\Entity\Contrat implements \Doctrine\ORM\Proxy\Proxy
{
    /**
     * @var \Closure the callback responsible for loading properties in the proxy object. This callback is called with
     *      three parameters, being respectively the proxy object to be initialized, the method that triggered the
     *      initialization process and an array of ordered parameters that were passed to that method.
     *
     * @see \Doctrine\Common\Proxy\Proxy::__setInitializer
     */
    public $__initializer__;

    /**
     * @var \Closure the callback responsible of loading properties that need to be copied in the cloned object
     *
     * @see \Doctrine\Common\Proxy\Proxy::__setCloner
     */
    public $__cloner__;

    /**
     * @var boolean flag indicating if this object was already initialized
     *
     * @see \Doctrine\Persistence\Proxy::__isInitialized
     */
    public $__isInitialized__ = false;

    /**
     * @var array<string, null> properties to be lazy loaded, indexed by property name
     */
    public static $lazyPropertiesNames = array (
);

    /**
     * @var array<string, mixed> default values of properties to be lazy loaded, with keys being the property names
     *
     * @see \Doctrine\Common\Proxy\Proxy::__getLazyProperties
     */
    public static $lazyPropertiesDefaults = array (
);



    public function __construct(?\Closure $initializer = null, ?\Closure $cloner = null)
    {

        $this->__initializer__ = $initializer;
        $this->__cloner__      = $cloner;
    }







    /**
     * 
     * @return array
     */
    public function __sleep()
    {
        if ($this->__isInitialized__) {
            return ['__isInitialized__', '' . "\0" . 'App\\Entity\\Contrat' . "\0" . 'id', '' . "\0" . 'App\\Entity\\Contrat' . "\0" . 'numContrat', '' . "\0" . 'App\\Entity\\Contrat' . "\0" . 'reference', '' . "\0" . 'App\\Entity\\Contrat' . "\0" . 'libele', '' . "\0" . 'App\\Entity\\Contrat' . "\0" . 'intitule', '' . "\0" . 'App\\Entity\\Contrat' . "\0" . 'arrete', '' . "\0" . 'App\\Entity\\Contrat' . "\0" . 'preambule', '' . "\0" . 'App\\Entity\\Contrat' . "\0" . 'article1', '' . "\0" . 'App\\Entity\\Contrat' . "\0" . 'article2', '' . "\0" . 'App\\Entity\\Contrat' . "\0" . 'article3', '' . "\0" . 'App\\Entity\\Contrat' . "\0" . 'article4', '' . "\0" . 'App\\Entity\\Contrat' . "\0" . 'article5', '' . "\0" . 'App\\Entity\\Contrat' . "\0" . 'article6', '' . "\0" . 'App\\Entity\\Contrat' . "\0" . 'article7', '' . "\0" . 'App\\Entity\\Contrat' . "\0" . 'article8', '' . "\0" . 'App\\Entity\\Contrat' . "\0" . 'article9', '' . "\0" . 'App\\Entity\\Contrat' . "\0" . 'article10', '' . "\0" . 'App\\Entity\\Contrat' . "\0" . 'factures', '' . "\0" . 'App\\Entity\\Contrat' . "\0" . 'client', '' . "\0" . 'App\\Entity\\Contrat' . "\0" . 'createdAt', '' . "\0" . 'App\\Entity\\Contrat' . "\0" . 'userCreateur', '' . "\0" . 'App\\Entity\\Contrat' . "\0" . 'echeancier', '' . "\0" . 'App\\Entity\\Contrat' . "\0" . 'commandes'];
        }

        return ['__isInitialized__', '' . "\0" . 'App\\Entity\\Contrat' . "\0" . 'id', '' . "\0" . 'App\\Entity\\Contrat' . "\0" . 'numContrat', '' . "\0" . 'App\\Entity\\Contrat' . "\0" . 'reference', '' . "\0" . 'App\\Entity\\Contrat' . "\0" . 'libele', '' . "\0" . 'App\\Entity\\Contrat' . "\0" . 'intitule', '' . "\0" . 'App\\Entity\\Contrat' . "\0" . 'arrete', '' . "\0" . 'App\\Entity\\Contrat' . "\0" . 'preambule', '' . "\0" . 'App\\Entity\\Contrat' . "\0" . 'article1', '' . "\0" . 'App\\Entity\\Contrat' . "\0" . 'article2', '' . "\0" . 'App\\Entity\\Contrat' . "\0" . 'article3', '' . "\0" . 'App\\Entity\\Contrat' . "\0" . 'article4', '' . "\0" . 'App\\Entity\\Contrat' . "\0" . 'article5', '' . "\0" . 'App\\Entity\\Contrat' . "\0" . 'article6', '' . "\0" . 'App\\Entity\\Contrat' . "\0" . 'article7', '' . "\0" . 'App\\Entity\\Contrat' . "\0" . 'article8', '' . "\0" . 'App\\Entity\\Contrat' . "\0" . 'article9', '' . "\0" . 'App\\Entity\\Contrat' . "\0" . 'article10', '' . "\0" . 'App\\Entity\\Contrat' . "\0" . 'factures', '' . "\0" . 'App\\Entity\\Contrat' . "\0" . 'client', '' . "\0" . 'App\\Entity\\Contrat' . "\0" . 'createdAt', '' . "\0" . 'App\\Entity\\Contrat' . "\0" . 'userCreateur', '' . "\0" . 'App\\Entity\\Contrat' . "\0" . 'echeancier', '' . "\0" . 'App\\Entity\\Contrat' . "\0" . 'commandes'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (Contrat $proxy) {
                $proxy->__setInitializer(null);
                $proxy->__setCloner(null);

                $existingProperties = get_object_vars($proxy);

                foreach ($proxy::$lazyPropertiesDefaults as $property => $defaultValue) {
                    if ( ! array_key_exists($property, $existingProperties)) {
                        $proxy->$property = $defaultValue;
                    }
                }
            };

        }
    }

    /**
     * 
     */
    public function __clone()
    {
        $this->__cloner__ && $this->__cloner__->__invoke($this, '__clone', []);
    }

    /**
     * Forces initialization of the proxy
     */
    public function __load()
    {
        $this->__initializer__ && $this->__initializer__->__invoke($this, '__load', []);
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitialized($initialized)
    {
        $this->__isInitialized__ = $initialized;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitializer(\Closure $initializer = null)
    {
        $this->__initializer__ = $initializer;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __getInitializer()
    {
        return $this->__initializer__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setCloner(\Closure $cloner = null)
    {
        $this->__cloner__ = $cloner;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific cloning logic
     */
    public function __getCloner()
    {
        return $this->__cloner__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     * @deprecated no longer in use - generated code now relies on internal components rather than generated public API
     * @static
     */
    public function __getLazyProperties()
    {
        return self::$lazyPropertiesDefaults;
    }

    
    /**
     * {@inheritDoc}
     */
    public function getId(): ?int
    {
        if ($this->__isInitialized__ === false) {
            return (int)  parent::getId();
        }


        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getId', []);

        return parent::getId();
    }

    /**
     * {@inheritDoc}
     */
    public function getReference(): ?string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getReference', []);

        return parent::getReference();
    }

    /**
     * {@inheritDoc}
     */
    public function setReference(string $reference): \App\Entity\Contrat
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setReference', [$reference]);

        return parent::setReference($reference);
    }

    /**
     * {@inheritDoc}
     */
    public function getNumContrat()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getNumContrat', []);

        return parent::getNumContrat();
    }

    /**
     * {@inheritDoc}
     */
    public function setNumContrat($numContrat)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setNumContrat', [$numContrat]);

        return parent::setNumContrat($numContrat);
    }

    /**
     * {@inheritDoc}
     */
    public function getLibele(): ?string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getLibele', []);

        return parent::getLibele();
    }

    /**
     * {@inheritDoc}
     */
    public function setLibele(string $libele): \App\Entity\Contrat
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setLibele', [$libele]);

        return parent::setLibele($libele);
    }

    /**
     * {@inheritDoc}
     */
    public function getIntitule(): ?string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIntitule', []);

        return parent::getIntitule();
    }

    /**
     * {@inheritDoc}
     */
    public function setIntitule(string $intitule): \App\Entity\Contrat
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIntitule', [$intitule]);

        return parent::setIntitule($intitule);
    }

    /**
     * {@inheritDoc}
     */
    public function getPreambule(): ?string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPreambule', []);

        return parent::getPreambule();
    }

    /**
     * {@inheritDoc}
     */
    public function setPreambule(string $preambule): \App\Entity\Contrat
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPreambule', [$preambule]);

        return parent::setPreambule($preambule);
    }

    /**
     * {@inheritDoc}
     */
    public function getArrete(): ?string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getArrete', []);

        return parent::getArrete();
    }

    /**
     * {@inheritDoc}
     */
    public function setArrete(string $arrete): \App\Entity\Contrat
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setArrete', [$arrete]);

        return parent::setArrete($arrete);
    }

    /**
     * {@inheritDoc}
     */
    public function getArticle1(): ?string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getArticle1', []);

        return parent::getArticle1();
    }

    /**
     * {@inheritDoc}
     */
    public function setArticle1(string $article1): \App\Entity\Contrat
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setArticle1', [$article1]);

        return parent::setArticle1($article1);
    }

    /**
     * {@inheritDoc}
     */
    public function getArticle2(): ?string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getArticle2', []);

        return parent::getArticle2();
    }

    /**
     * {@inheritDoc}
     */
    public function setArticle2(string $article2): \App\Entity\Contrat
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setArticle2', [$article2]);

        return parent::setArticle2($article2);
    }

    /**
     * {@inheritDoc}
     */
    public function getArticle3(): ?string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getArticle3', []);

        return parent::getArticle3();
    }

    /**
     * {@inheritDoc}
     */
    public function setArticle3(string $article3): \App\Entity\Contrat
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setArticle3', [$article3]);

        return parent::setArticle3($article3);
    }

    /**
     * {@inheritDoc}
     */
    public function getArticle4(): ?string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getArticle4', []);

        return parent::getArticle4();
    }

    /**
     * {@inheritDoc}
     */
    public function setArticle4(string $article4): \App\Entity\Contrat
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setArticle4', [$article4]);

        return parent::setArticle4($article4);
    }

    /**
     * {@inheritDoc}
     */
    public function getArticle5(): ?string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getArticle5', []);

        return parent::getArticle5();
    }

    /**
     * {@inheritDoc}
     */
    public function setArticle5(string $article5): \App\Entity\Contrat
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setArticle5', [$article5]);

        return parent::setArticle5($article5);
    }

    /**
     * {@inheritDoc}
     */
    public function getArticle6(): ?string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getArticle6', []);

        return parent::getArticle6();
    }

    /**
     * {@inheritDoc}
     */
    public function setArticle6(string $article6): \App\Entity\Contrat
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setArticle6', [$article6]);

        return parent::setArticle6($article6);
    }

    /**
     * {@inheritDoc}
     */
    public function getArticle7(): ?string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getArticle7', []);

        return parent::getArticle7();
    }

    /**
     * {@inheritDoc}
     */
    public function setArticle7(string $article7): \App\Entity\Contrat
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setArticle7', [$article7]);

        return parent::setArticle7($article7);
    }

    /**
     * {@inheritDoc}
     */
    public function getArticle8(): ?string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getArticle8', []);

        return parent::getArticle8();
    }

    /**
     * {@inheritDoc}
     */
    public function setArticle8(string $article8): \App\Entity\Contrat
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setArticle8', [$article8]);

        return parent::setArticle8($article8);
    }

    /**
     * {@inheritDoc}
     */
    public function getArticle9(): ?string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getArticle9', []);

        return parent::getArticle9();
    }

    /**
     * {@inheritDoc}
     */
    public function setArticle9(string $article9): \App\Entity\Contrat
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setArticle9', [$article9]);

        return parent::setArticle9($article9);
    }

    /**
     * {@inheritDoc}
     */
    public function getArticle10(): ?string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getArticle10', []);

        return parent::getArticle10();
    }

    /**
     * {@inheritDoc}
     */
    public function setArticle10(string $article10): \App\Entity\Contrat
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setArticle10', [$article10]);

        return parent::setArticle10($article10);
    }

    /**
     * {@inheritDoc}
     */
    public function getFactures(): \Doctrine\Common\Collections\Collection
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getFactures', []);

        return parent::getFactures();
    }

    /**
     * {@inheritDoc}
     */
    public function addFacture(\App\Entity\Facture $facture): \App\Entity\Contrat
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addFacture', [$facture]);

        return parent::addFacture($facture);
    }

    /**
     * {@inheritDoc}
     */
    public function removeFacture(\App\Entity\Facture $facture): \App\Entity\Contrat
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeFacture', [$facture]);

        return parent::removeFacture($facture);
    }

    /**
     * {@inheritDoc}
     */
    public function getClient(): ?\App\Entity\Client
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getClient', []);

        return parent::getClient();
    }

    /**
     * {@inheritDoc}
     */
    public function setClient(?\App\Entity\Client $client): \App\Entity\Contrat
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setClient', [$client]);

        return parent::setClient($client);
    }

    /**
     * {@inheritDoc}
     */
    public function getCreatedAt(): ?\DateTimeInterface
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCreatedAt', []);

        return parent::getCreatedAt();
    }

    /**
     * {@inheritDoc}
     */
    public function setCreatedAt(\DateTimeInterface $createdAt): \App\Entity\Contrat
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCreatedAt', [$createdAt]);

        return parent::setCreatedAt($createdAt);
    }

    /**
     * {@inheritDoc}
     */
    public function getUserCreateur(): ?\App\Entity\User
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getUserCreateur', []);

        return parent::getUserCreateur();
    }

    /**
     * {@inheritDoc}
     */
    public function setUserCreateur(?\App\Entity\User $userCreateur): \App\Entity\Contrat
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setUserCreateur', [$userCreateur]);

        return parent::setUserCreateur($userCreateur);
    }

    /**
     * {@inheritDoc}
     */
    public function getEcheancier(): ?\App\Entity\Echeancier
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEcheancier', []);

        return parent::getEcheancier();
    }

    /**
     * {@inheritDoc}
     */
    public function setEcheancier(?\App\Entity\Echeancier $echeancier): \App\Entity\Contrat
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setEcheancier', [$echeancier]);

        return parent::setEcheancier($echeancier);
    }

    /**
     * {@inheritDoc}
     */
    public function getCommandes(): \Doctrine\Common\Collections\Collection
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCommandes', []);

        return parent::getCommandes();
    }

    /**
     * {@inheritDoc}
     */
    public function addCommande(\App\Entity\Commande $commande): \App\Entity\Contrat
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addCommande', [$commande]);

        return parent::addCommande($commande);
    }

    /**
     * {@inheritDoc}
     */
    public function removeCommande(\App\Entity\Commande $commande): \App\Entity\Contrat
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeCommande', [$commande]);

        return parent::removeCommande($commande);
    }

}
