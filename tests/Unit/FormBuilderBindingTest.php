<?php

declare(strict_types=1);

namespace BagasTopati\FormBuilder\Tests\Unit;

use BagasTopati\UiCore\Builders\FormBuilder;
use PHPUnit\Framework\TestCase;

class FormBuilderBindingTest extends TestCase
{
    /**
     * Test 1: Fluent API value() method sets field value
     */
    public function test_value_method_sets_field_value(): void
    {
        $form = FormBuilder::fromArray([
            'action' => '/test',
            'fields' => [
                ['type' => 'text', 'name' => 'name']
            ]
        ]);

        $form->text('email')->value('john@example.com');
        $html = $form->render();

        $this->assertStringContainsString('value=\'john@example.com\'', $html);
    }

    /**
     * Test 2: Bind array sets multiple field values
     */
    public function test_bind_array_sets_multiple_values(): void
    {
        $form = FormBuilder::fromArray([
            'action' => '/test',
            'fields' => [
                ['type' => 'text', 'name' => 'name'],
                ['type' => 'email', 'name' => 'email']
            ]
        ]);

        $form->bind(['name' => 'John', 'email' => 'john@example.com']);
        $html = $form->render();

        $this->assertStringContainsString('value=\'John\'', $html);
        $this->assertStringContainsString('value=\'john@example.com\'', $html);
    }

    /**
     * Test 3: Bind object/stdClass sets values
     */
    public function test_bind_object_sets_values(): void
    {
        $user = (object)[
            'name' => 'Jane',
            'email' => 'jane@example.com'
        ];

        $form = FormBuilder::fromArray([
            'action' => '/test',
            'fields' => [
                ['type' => 'text', 'name' => 'name'],
                ['type' => 'email', 'name' => 'email']
            ]
        ]);

        $form->bind($user);
        $html = $form->render();

        $this->assertStringContainsString('value=\'Jane\'', $html);
    }

    /**
     * Test 4: Bind with nested object properties
     */
    public function test_bind_nested_object_properties(): void
    {
        $data = (object)[
            'user' => (object)[
                'profile' => (object)[
                    'avatar' => 'avatar.jpg'
                ]
            ]
        ];

        $form = FormBuilder::fromArray([
            'action' => '/test',
            'fields' => [
                ['type' => 'text', 'name' => 'user.profile.avatar']
            ]
        ]);

        $form->bind($data);
        $html = $form->render();

        $this->assertStringContainsString('value=\'avatar.jpg\'', $html);
    }

    /**
     * Test 5: Bind with nested array values
     */
    public function test_bind_nested_array_values(): void
    {
        $form = FormBuilder::fromArray([
            'action' => '/test',
            'fields' => [
                ['type' => 'text', 'name' => 'user.profile.name']
            ]
        ]);

        $form->bind([
            'user' => [
                'profile' => [
                    'name' => 'Alice'
                ]
            ]
        ]);

        $html = $form->render();

        $this->assertStringContainsString('value=\'Alice\'', $html);
    }

    /**
     * Test 6: Bind sets selected attribute for select fields
     */
    public function test_bind_sets_selected_for_select_fields(): void
    {
        $form = FormBuilder::fromArray([
            'action' => '/test',
            'fields' => [
                [
                    'type' => 'select',
                    'name' => 'role',
                    'options' => [
                        'admin' => 'Administrator',
                        'user' => 'User'
                    ]
                ]
            ]
        ]);

        $form->bind(['role' => 'admin']);
        $html = $form->render();

        // The selected attribute should be present
        $this->assertStringContainsString('selected', $html);
    }

    /**
     * Test 7: Bind sets checked attribute for checkbox
     */
    public function test_bind_sets_checked_for_checkbox(): void
    {
        $form = FormBuilder::fromArray([
            'action' => '/test',
            'fields' => [
                ['type' => 'checkbox', 'name' => 'agree']
            ]
        ]);

        $form->bind(['agree' => true]);
        $html = $form->render();

        $this->assertStringContainsString('checked', $html);
    }

    /**
     * Test 8: Bind with null values is ignored
     */
    public function test_bind_ignores_null_values(): void
    {
        $form = FormBuilder::fromArray([
            'action' => '/test',
            'fields' => [
                ['type' => 'text', 'name' => 'name', 'default' => 'Default Name']
            ]
        ]);

        $form->bind(['name' => null]);
        $html = $form->render();

        // Default value should still be there since null was ignored
        $this->assertStringContainsString('value=\'Default Name\'', $html);
    }

    /**
     * Test 9: Bind missing fields are skipped gracefully
     */
    public function test_bind_missing_fields_skipped_gracefully(): void
    {
        $form = FormBuilder::fromArray([
            'action' => '/test',
            'fields' => [
                ['type' => 'text', 'name' => 'name'],
                ['type' => 'email', 'name' => 'email']
            ]
        ]);

        // Only binding name, not email
        $form->bind(['name' => 'John']);
        $html = $form->render();

        $this->assertStringContainsString('value=\'John\'', $html);
        // Should not crash or have unexpected behavior
        $this->assertIsString($html);
    }

    /**
     * Test 10: toJavaScriptVariables outputs correct format
     */
    public function test_to_javascript_variables_outputs_correct_format(): void
    {
        $form = FormBuilder::fromArray([
            'action' => '/test',
            'fields' => [
                ['type' => 'text', 'name' => 'name', 'default' => 'John'],
                ['type' => 'email', 'name' => 'email', 'default' => 'john@example.com']
            ]
        ]);

        $js = $form->toJavaScriptVariables('userData');

        $this->assertStringContainsString('const userData =', $js);
        $this->assertStringContainsString('"name":"John"', $js);
        $this->assertStringContainsString('"email":"john@example.com"', $js);
    }

    /**
     * Test 11: toJavaScriptObject with default name
     */
    public function test_to_javascript_object_with_default_name(): void
    {
        $form = FormBuilder::fromArray([
            'action' => '/test',
            'fields' => [
                ['type' => 'text', 'name' => 'username', 'default' => 'johndoe']
            ]
        ]);

        $js = $form->toJavaScriptObject();

        $this->assertStringContainsString('const formData =', $js);
        $this->assertStringContainsString('johndoe', $js);
    }

    /**
     * Test 12: Fluent method chaining works
     */
    public function test_fluent_method_chaining_works(): void
    {
        $form = FormBuilder::fromArray([
            'action' => '/test',
            'fields' => []
        ]);

        $result = $form->text('field1')->value('value1')->email('field2')->value('test@example.com');

        // Should return FormBuilder instance for chaining
        $this->assertInstanceOf(FormBuilder::class, $result);

        $html = $result->render();
        $this->assertStringContainsString('value=\'value1\'', $html);
        $this->assertStringContainsString('value=\'test@example.com\'', $html);
    }

    /**
     * Test 13: Bind auto-detects object vs array
     */
    public function test_bind_auto_detects_object_vs_array(): void
    {
        $form1 = FormBuilder::fromArray([
            'action' => '/test',
            'fields' => [['type' => 'text', 'name' => 'name']]
        ]);

        $form2 = FormBuilder::fromArray([
            'action' => '/test',
            'fields' => [['type' => 'text', 'name' => 'name']]
        ]);

        // Bind object
        $form1->bind((object)['name' => 'From Object']);
        // Bind array
        $form2->bind(['name' => 'From Array']);

        $this->assertStringContainsString('From Object', $form1->render());
        $this->assertStringContainsString('From Array', $form2->render());
    }

    /**
     * Test 14: selected() method works for select fields
     */
    public function test_selected_method_works(): void
    {
        $form = FormBuilder::fromArray([
            'action' => '/test',
            'fields' => []
        ]);

        $form->select('role', ['admin' => 'Admin', 'user' => 'User'])->selected('admin');
        $html = $form->render();

        $this->assertStringContainsString('selected', $html);
    }

    /**
     * Test 15: checked() method works for checkbox/radio
     */
    public function test_checked_method_works(): void
    {
        $form = FormBuilder::fromArray([
            'action' => '/test',
            'fields' => []
        ]);

        $form->checkbox('agree')->checked(true);
        $html = $form->render();

        $this->assertStringContainsString('checked', $html);
    }

    /**
     * Test 16: Deeply nested objects work
     */
    public function test_deeply_nested_objects_work(): void
    {
        $data = (object)[
            'company' => (object)[
                'department' => (object)[
                    'team' => (object)[
                        'lead' => 'Alice'
                    ]
                ]
            ]
        ];

        $form = FormBuilder::fromArray([
            'action' => '/test',
            'fields' => [
                ['type' => 'text', 'name' => 'company.department.team.lead']
            ]
        ]);

        $form->bind($data);
        $html = $form->render();

        $this->assertStringContainsString('value=\'Alice\'', $html);
    }

    /**
     * Test 17: Empty form data exports empty JavaScript
     */
    public function test_empty_form_exports_empty_javascript(): void
    {
        $form = FormBuilder::fromArray([
            'action' => '/test',
            'fields' => [
                ['type' => 'text', 'name' => 'field1']  // No default value
            ]
        ]);

        $js = $form->toJavaScriptVariables('data');

        // Should have empty object
        $this->assertStringContainsString('const data = {}', $js);
    }
}
