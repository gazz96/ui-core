<?php

declare(strict_types=1);

namespace BagasTopati\FormBuilder\Tests\Unit;

use BagasTopati\UiCore\Builders\FormBuilder;
use PHPUnit\Framework\TestCase;

class FormBuilderArrayTest extends TestCase
{
    public function test_can_create_form_from_array()
    {
        $config = [
            'action' => '/users/store',
            'method' => 'POST',
            'fields' => [
                [
                    'type' => 'text',
                    'name' => 'name',
                    'label' => 'Full Name',
                ]
            ]
        ];

        $form = FormBuilder::fromArray($config);

        $this->assertInstanceOf(FormBuilder::class, $form);
        $this->assertStringContainsString('action="/users/store"', $form->render());
    }

    public function test_can_create_form_from_json()
    {
        $json = json_encode([
            'action' => '/users/store',
            'method' => 'POST',
            'fields' => [
                [
                    'type' => 'text',
                    'name' => 'name',
                    'label' => 'Full Name',
                ]
            ]
        ]);

        $form = FormBuilder::fromJson($json);

        $this->assertInstanceOf(FormBuilder::class, $form);
        $this->assertStringContainsString('action="/users/store"', $form->render());
    }

    public function test_throws_exception_for_missing_action()
    {
        $this->expectException(\InvalidArgumentException::class);

        FormBuilder::fromArray([
            'method' => 'POST',
            'fields' => []
        ]);
    }

    public function test_throws_exception_for_missing_field_name()
    {
        $this->expectException(\InvalidArgumentException::class);

        FormBuilder::fromArray([
            'action' => '/test',
            'fields' => [
                ['type' => 'text']
            ]
        ]);
    }

    public function test_throws_exception_for_invalid_json()
    {
        $this->expectException(\InvalidArgumentException::class);

        FormBuilder::fromJson('invalid json');
    }

    public function test_parses_text_field()
    {
        $config = [
            'action' => '/test',
            'fields' => [
                [
                    'type' => 'text',
                    'name' => 'email',
                    'label' => 'Email Address',
                    'placeholder' => 'Enter your email',
                ]
            ]
        ];

        $form = FormBuilder::fromArray($config);
        $html = $form->render();

        $this->assertStringContainsString('type=\'text\'', $html);
        $this->assertStringContainsString('name=\'email\'', $html);
        $this->assertStringContainsString('placeholder=\'Enter your email\'', $html);
    }

    public function test_parses_email_field()
    {
        $config = [
            'action' => '/test',
            'fields' => [
                [
                    'type' => 'email',
                    'name' => 'email',
                    'label' => 'Email',
                ]
            ]
        ];

        $form = FormBuilder::fromArray($config);
        $html = $form->render();

        $this->assertStringContainsString('type=\'email\'', $html);
    }

    public function test_parses_select_field()
    {
        $config = [
            'action' => '/test',
            'fields' => [
                [
                    'type' => 'select',
                    'name' => 'role',
                    'label' => 'Role',
                    'options' => [
                        'admin' => 'Administrator',
                        'editor' => 'Editor',
                    ],
                    'default' => 'editor',
                ]
            ]
        ];

        $form = FormBuilder::fromArray($config);
        $html = $form->render();

        $this->assertStringContainsString('<select', $html);
        $this->assertStringContainsString('Administrator', $html);
        $this->assertStringContainsString('selected', $html);
    }

    public function test_parses_textarea_field()
    {
        $config = [
            'action' => '/test',
            'fields' => [
                [
                    'type' => 'textarea',
                    'name' => 'bio',
                    'label' => 'Biography',
                    'rows' => 5,
                ]
            ]
        ];

        $form = FormBuilder::fromArray($config);
        $html = $form->render();

        $this->assertStringContainsString('<textarea', $html);
        $this->assertStringContainsString('rows=\'5\'', $html);
    }

    public function test_parses_checkbox_field()
    {
        $config = [
            'action' => '/test',
            'fields' => [
                [
                    'type' => 'checkbox',
                    'name' => 'subscribe',
                    'label' => 'Subscribe',
                ]
            ]
        ];

        $form = FormBuilder::fromArray($config);
        $html = $form->render();

        $this->assertStringContainsString('type=\'checkbox\'', $html);
    }

    public function test_parses_radio_field()
    {
        $config = [
            'action' => '/test',
            'fields' => [
                [
                    'type' => 'radio',
                    'name' => 'gender',
                    'label' => 'Gender',
                    'options' => [
                        'M' => 'Male',
                        'F' => 'Female',
                    ]
                ]
            ]
        ];

        $form = FormBuilder::fromArray($config);
        $html = $form->render();

        $this->assertStringContainsString('type=\'radio\'', $html);
        $this->assertStringContainsString('Male', $html);
        $this->assertStringContainsString('Female', $html);
    }

    public function test_parses_file_field()
    {
        $config = [
            'action' => '/test',
            'fields' => [
                [
                    'type' => 'file',
                    'name' => 'avatar',
                    'label' => 'Profile Picture',
                    'accept' => 'image/*',
                ]
            ]
        ];

        $form = FormBuilder::fromArray($config);
        $html = $form->render();

        $this->assertStringContainsString('type=\'file\'', $html);
        $this->assertStringContainsString('accept=\'image/*\'', $html);
    }

    public function test_parses_hidden_field()
    {
        $config = [
            'action' => '/test',
            'fields' => [
                [
                    'type' => 'hidden',
                    'name' => 'token',
                    'value' => 'abc123',
                ]
            ]
        ];

        $form = FormBuilder::fromArray($config);
        $html = $form->render();

        $this->assertStringContainsString('type=\'hidden\'', $html);
        $this->assertStringContainsString('abc123', $html);
    }

    public function test_parses_buttons()
    {
        $config = [
            'action' => '/test',
            'buttons' => [
                [
                    'type' => 'submit',
                    'label' => 'Save',
                ],
                [
                    'type' => 'reset',
                    'label' => 'Clear',
                ]
            ]
        ];

        $form = FormBuilder::fromArray($config);
        $html = $form->render();

        $this->assertStringContainsString('Save', $html);
        $this->assertStringContainsString('Clear', $html);
    }

    public function test_applies_form_attributes()
    {
        $config = [
            'action' => '/test',
            'method' => 'POST',
            'attributes' => [
                'class' => 'my-form',
                'id' => 'user-form',
            ],
            'fields' => []
        ];

        $form = FormBuilder::fromArray($config);
        $html = $form->render();

        $this->assertStringContainsString('id="user-form"', $html);
    }

    public function test_parses_form_method()
    {
        $config = [
            'action' => '/test',
            'method' => 'PUT',
            'fields' => []
        ];

        $form = FormBuilder::fromArray($config);
        $html = $form->render();

        $this->assertStringContainsString('name=\'_method\'', $html);
        $this->assertStringContainsString('PUT', $html);
    }

    public function test_to_array_returns_config()
    {
        $config = [
            'action' => '/test',
            'method' => 'POST',
            'fields' => [
                [
                    'type' => 'text',
                    'name' => 'name',
                    'label' => 'Name',
                ]
            ]
        ];

        $form = FormBuilder::fromArray($config);
        $array = $form->toArray();

        $this->assertEquals('/test', $array['action']);
        $this->assertEquals('POST', $array['method']);
        $this->assertNotEmpty($array['fields']);
    }

    public function test_to_json_returns_valid_json()
    {
        $config = [
            'action' => '/test',
            'method' => 'POST',
            'fields' => []
        ];

        $form = FormBuilder::fromArray($config);
        $json = $form->toJson();

        $decoded = json_decode($json, true);
        $this->assertIsArray($decoded);
        $this->assertEquals('/test', $decoded['action']);
    }

    public function test_parses_default_values()
    {
        $config = [
            'action' => '/test',
            'fields' => [
                [
                    'type' => 'text',
                    'name' => 'name',
                    'default' => 'John Doe',
                ]
            ]
        ];

        $form = FormBuilder::fromArray($config);
        $html = $form->render();

        $this->assertStringContainsString('John Doe', $html);
    }

    public function test_stores_validation_rules()
    {
        $config = [
            'action' => '/test',
            'fields' => [
                [
                    'type' => 'text',
                    'name' => 'email',
                    'validation' => 'required|email|max:255',
                ]
            ]
        ];

        $form = FormBuilder::fromArray($config);
        $rules = $form->getValidationRules();

        $this->assertEquals('required|email|max:255', $rules['email']);
    }

    public function test_adds_required_attribute()
    {
        $config = [
            'action' => '/test',
            'fields' => [
                [
                    'type' => 'text',
                    'name' => 'email',
                    'required' => true,
                ]
            ]
        ];

        $form = FormBuilder::fromArray($config);
        $html = $form->render();

        $this->assertStringContainsString('required', $html);
    }

    public function test_unsupported_field_type_throws_exception()
    {
        $this->expectException(\InvalidArgumentException::class);

        FormBuilder::fromArray([
            'action' => '/test',
            'fields' => [
                [
                    'type' => 'unsupported_type',
                    'name' => 'test',
                ]
            ]
        ]);
    }

    public function test_unsupported_button_type_throws_exception()
    {
        $this->expectException(\InvalidArgumentException::class);

        FormBuilder::fromArray([
            'action' => '/test',
            'buttons' => [
                [
                    'type' => 'unsupported_button',
                    'label' => 'Test',
                ]
            ]
        ]);
    }
}
