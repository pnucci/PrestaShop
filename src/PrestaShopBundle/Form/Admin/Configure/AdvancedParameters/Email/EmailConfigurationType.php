<?php
/**
 * 2007-2018 PrestaShop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/OSL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://www.prestashop.com for more information.
 *
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2007-2018 PrestaShop SA
 * @license   https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 * International Registered Trademark & Property of PrestaShop SA
 */

namespace PrestaShopBundle\Form\Admin\Configure\AdvancedParameters\Email;

use PrestaShop\PrestaShop\Core\Form\FormChoiceProviderInterface;
use PrestaShopBundle\Form\Admin\Type\SwitchType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class EmailConfigurationType defines email sending configuration
 */
class EmailConfigurationType extends AbstractType
{
    /**
     * @var FormChoiceProviderInterface
     */
    private $mailMethodChoiceProvider;

    /**
     * @var FormChoiceProviderInterface
     */
    private $contactsChoiceProvider;

    /**
     * @param FormChoiceProviderInterface $mailMethodChoiceProvider
     * @param FormChoiceProviderInterface $contactsChoiceProvider
     */
    public function __construct(
        FormChoiceProviderInterface $mailMethodChoiceProvider,
        FormChoiceProviderInterface $contactsChoiceProvider
    ) {
        $this->mailMethodChoiceProvider = $mailMethodChoiceProvider;
        $this->contactsChoiceProvider = $contactsChoiceProvider;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('send_emails_to', ChoiceType::class, [
                'choices' => $this->contactsChoiceProvider->getChoices(),
            ])
            ->add('mail_method', ChoiceType::class, [
                'expanded' => true,
                'multiple' => false,
                'choices' => $this->mailMethodChoiceProvider->getChoices(),
            ])
            ->add('mail_type', ChoiceType::class, [
                'expanded' => true,
                'multiple' => false,
                'choices' => [
                    'Send email in HTML format' => 1,
                    'Send email in text format' => 2,
                    'Both' => 3,
                ],
            ])
            ->add('log_emails', SwitchType::class)
        ;
    }
}
