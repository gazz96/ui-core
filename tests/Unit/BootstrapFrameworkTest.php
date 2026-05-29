<?php

declare(strict_types=1);

namespace BagasTopati\FormBuilder\Tests\Unit;

use BagasTopati\UiCore\Builders\FormBuilder;
use BagasTopati\UiCore\CssFrameworks\Bootstrap4Framework;
use BagasTopati\UiCore\CssFrameworks\Bootstrap5Framework;
use BagasTopati\UiCore\UI;
use PHPUnit\Framework\TestCase;

class BootstrapFrameworkTest extends TestCase
{
    public function test_bootstrap4_form_rendering()
    {
        UI::useBootstrap(); // Default uses current bootstrap
        UI::setFramework(new Bootstrap4Framework());

        $form = FormBuilder::fromArray([
            'action' => '/test',
            'fields' => [
                ['type' => 'text', 'name' => 'name', 'label' => 'Name'],
                ['type' => 'email', 'name' => 'email', 'label' => 'Email'],
            ]
        ]);

        $html = $form->render();

        // Bootstrap 4 specific classes
        $this->assertStringContainsString('form-group', $html);
        $this->assertStringContainsString('form-control-label', $html);
        $this->assertStringContainsString('form-control', $html);
    }

    public function test_bootstrap5_form_rendering()
    {
        UI::setFramework(new Bootstrap5Framework());

        $form = FormBuilder::fromArray([
            'action' => '/test',
            'fields' => [
                ['type' => 'text', 'name' => 'name', 'label' => 'Name'],
                ['type' => 'email', 'name' => 'email', 'label' => 'Email'],
            ]
        ]);

        $html = $form->render();

        // Bootstrap 5 specific classes
        $this->assertStringContainsString('mb-3', $html);
        $this->assertStringContainsString('form-label', $html);
        $this->assertStringContainsString('form-control', $html);
    }

    public function test_bootstrap4_select_field()
    {
        UI::setFramework(new Bootstrap4Framework());

        $form = FormBuilder::fromArray([
            'action' => '/test',
            'fields' => [
                [
                    'type' => 'select',
                    'name' => 'role',
                    'options' => ['admin' => 'Admin', 'user' => 'User']
                ]
            ]
        ]);

        $html = $form->render();

        // Bootstrap 4 uses custom-select for select fields
        $this->assertStringContainsString('custom-select', $html);
        $this->assertStringContainsString('form-control', $html);
    }

    public function test_bootstrap5_select_field()
    {
        UI::setFramework(new Bootstrap5Framework());

        $form = FormBuilder::fromArray([
            'action' => '/test',
            'fields' => [
                [
                    'type' => 'select',
                    'name' => 'role',
                    'options' => ['admin' => 'Admin', 'user' => 'User']
                ]
            ]
        ]);

        $html = $form->render();

        // Bootstrap 5 uses form-select
        $this->assertStringContainsString('form-select', $html);
        $this->assertStringNotContainsString('custom-select', $html);
    }

    public function test_bootstrap4_checkbox_field()
    {
        UI::setFramework(new Bootstrap4Framework());

        $form = FormBuilder::fromArray([
            'action' => '/test',
            'fields' => [
                [
                    'type' => 'checkbox',
                    'name' => 'agree',
                    'checkbox_label' => 'I agree'
                ]
            ]
        ]);

        $html = $form->render();

        $this->assertStringContainsString('form-check', $html);
        $this->assertStringContainsString('type=\'checkbox\'', $html);
    }

    public function test_bootstrap5_checkbox_field()
    {
        UI::setFramework(new Bootstrap5Framework());

        $form = FormBuilder::fromArray([
            'action' => '/test',
            'fields' => [
                [
                    'type' => 'checkbox',
                    'name' => 'agree',
                    'checkbox_label' => 'I agree'
                ]
            ]
        ]);

        $html = $form->render();

        $this->assertStringContainsString('form-check', $html);
        $this->assertStringContainsString('type=\'checkbox\'', $html);
    }

    public function test_bootstrap4_radio_field()
    {
        UI::setFramework(new Bootstrap4Framework());

        $form = FormBuilder::fromArray([
            'action' => '/test',
            'fields' => [
                [
                    'type' => 'radio',
                    'name' => 'gender',
                    'options' => ['M' => 'Male', 'F' => 'Female']
                ]
            ]
        ]);

        $html = $form->render();

        $this->assertStringContainsString('form-check', $html);
        $this->assertStringContainsString('type=\'radio\'', $html);
    }

    public function test_bootstrap5_radio_field()
    {
        UI::setFramework(new Bootstrap5Framework());

        $form = FormBuilder::fromArray([
            'action' => '/test',
            'fields' => [
                [
                    'type' => 'radio',
                    'name' => 'gender',
                    'options' => ['M' => 'Male', 'F' => 'Female']
                ]
            ]
        ]);

        $html = $form->render();

        $this->assertStringContainsString('form-check', $html);
        $this->assertStringContainsString('type=\'radio\'', $html);
    }

    public function test_bootstrap4_form_row()
    {
        UI::setFramework(new Bootstrap4Framework());

        $form = FormBuilder::fromArray([
            'action' => '/test',
            'fields' => [
                [
                    'type' => 'row',
                    'fields' => [
                        ['type' => 'text', 'name' => 'first_name', 'label' => 'First Name'],
                        ['type' => 'text', 'name' => 'last_name', 'label' => 'Last Name'],
                    ]
                ]
            ]
        ]);

        $html = $form->render();

        // Bootstrap 4 uses form-row
        $this->assertStringContainsString('form-row', $html);
    }

    public function test_bootstrap5_form_row()
    {
        UI::setFramework(new Bootstrap5Framework());

        $form = FormBuilder::fromArray([
            'action' => '/test',
            'fields' => [
                [
                    'type' => 'row',
                    'fields' => [
                        ['type' => 'text', 'name' => 'first_name', 'label' => 'First Name'],
                        ['type' => 'text', 'name' => 'last_name', 'label' => 'Last Name'],
                    ]
                ]
            ]
        ]);

        $html = $form->render();

        // Bootstrap 5 uses row with g-3
        $this->assertStringContainsString('row', $html);
        $this->assertStringContainsString('g-3', $html);
    }

    public function test_bootstrap4_buttons()
    {
        UI::setFramework(new Bootstrap4Framework());

        $form = FormBuilder::fromArray([
            'action' => '/test',
            'buttons' => [
                ['type' => 'submit', 'label' => 'Save'],
                ['type' => 'reset', 'label' => 'Reset']
            ]
        ]);

        $html = $form->render();

        $this->assertStringContainsString('btn btn-primary', $html);
        $this->assertStringContainsString('btn btn-secondary', $html);
    }

    public function test_bootstrap5_buttons()
    {
        UI::setFramework(new Bootstrap5Framework());

        $form = FormBuilder::fromArray([
            'action' => '/test',
            'buttons' => [
                ['type' => 'submit', 'label' => 'Save'],
                ['type' => 'reset', 'label' => 'Reset']
            ]
        ]);

        $html = $form->render();

        $this->assertStringContainsString('btn btn-primary', $html);
        $this->assertStringContainsString('btn btn-secondary', $html);
    }

    public function test_bootstrap4_textarea()
    {
        UI::setFramework(new Bootstrap4Framework());

        $form = FormBuilder::fromArray([
            'action' => '/test',
            'fields' => [
                [
                    'type' => 'textarea',
                    'name' => 'message',
                    'label' => 'Message',
                    'rows' => 5
                ]
            ]
        ]);

        $html = $form->render();

        $this->assertStringContainsString('form-control', $html);
        $this->assertStringContainsString('rows=\'5\'', $html);
    }

    public function test_bootstrap5_textarea()
    {
        UI::setFramework(new Bootstrap5Framework());

        $form = FormBuilder::fromArray([
            'action' => '/test',
            'fields' => [
                [
                    'type' => 'textarea',
                    'name' => 'message',
                    'label' => 'Message',
                    'rows' => 5
                ]
            ]
        ]);

        $html = $form->render();

        $this->assertStringContainsString('form-control', $html);
        $this->assertStringContainsString('rows=\'5\'', $html);
    }

    public function test_bootstrap4_file_field()
    {
        UI::setFramework(new Bootstrap4Framework());

        $form = FormBuilder::fromArray([
            'action' => '/test',
            'fields' => [
                [
                    'type' => 'file',
                    'name' => 'avatar',
                    'label' => 'Avatar'
                ]
            ]
        ]);

        $html = $form->render();

        $this->assertStringContainsString('form-control', $html);
        $this->assertStringContainsString('type=\'file\'', $html);
    }

    public function test_bootstrap5_file_field()
    {
        UI::setFramework(new Bootstrap5Framework());

        $form = FormBuilder::fromArray([
            'action' => '/test',
            'fields' => [
                [
                    'type' => 'file',
                    'name' => 'avatar',
                    'label' => 'Avatar'
                ]
            ]
        ]);

        $html = $form->render();

        $this->assertStringContainsString('form-control', $html);
        $this->assertStringContainsString('type=\'file\'', $html);
    }

    public function test_bootstrap4_external_css()
    {
        $framework = new Bootstrap4Framework();

        $this->assertTrue($framework->requiresExternalCss());
        $urls = $framework->externalCssUrls();
        $this->assertNotEmpty($urls);
        $this->assertStringContainsString('bootstrap@4', $urls[0]);
    }

    public function test_bootstrap5_external_css()
    {
        $framework = new Bootstrap5Framework();

        $this->assertTrue($framework->requiresExternalCss());
        $urls = $framework->externalCssUrls();
        $this->assertNotEmpty($urls);
        $this->assertStringContainsString('bootstrap@5', $urls[0]);
    }

    public function test_bootstrap4_external_js()
    {
        $framework = new Bootstrap4Framework();

        $urls = $framework->externalJsUrls();
        $this->assertNotEmpty($urls);
        // Bootstrap 4 requires jQuery, Popper, and Bootstrap JS
        $this->assertCount(3, $urls);
    }

    public function test_bootstrap5_external_js()
    {
        $framework = new Bootstrap5Framework();

        $urls = $framework->externalJsUrls();
        $this->assertNotEmpty($urls);
        // Bootstrap 5 only needs Bootstrap bundle (Popper included)
        $this->assertCount(1, $urls);
    }
}
