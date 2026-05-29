<?php

declare(strict_types=1);

/**
 * FormBuilder Examples
 *
 * This file demonstrates various ways to use the FormBuilder package
 */

use BagasTopati\UiCore\Builders\FormBuilder;
use BagasTopati\UiCore\UI;

// Set default framework
UI::useTailwind(); // or UI::useBootstrap()

// ============================================================================
// Example 1: Simple Contact Form from Array
// ============================================================================

$contactFormConfig = [
    'action' => '/contact/submit',
    'method' => 'POST',
    'fields' => [
        [
            'type' => 'text',
            'name' => 'name',
            'label' => 'Your Name',
            'placeholder' => 'Enter your full name',
            'validation' => 'required|string|max:255'
        ],
        [
            'type' => 'email',
            'name' => 'email',
            'label' => 'Email Address',
            'placeholder' => 'your@example.com',
            'validation' => 'required|email'
        ],
        [
            'type' => 'textarea',
            'name' => 'message',
            'label' => 'Message',
            'placeholder' => 'Your message here...',
            'rows' => 5,
            'validation' => 'required|string|max:1000'
        ]
    ],
    'buttons' => [
        [
            'type' => 'submit',
            'label' => 'Send Message'
        ]
    ]
];

// Create and render form
$contactForm = FormBuilder::fromArray($contactFormConfig);
echo "Contact Form:\n";
echo $contactForm->render();
echo "\n\n";

// ============================================================================
// Example 2: User Registration Form with Advanced Fields
// ============================================================================

$userRegistrationConfig = [
    'action' => route('users.store'),
    'method' => 'POST',
    'attributes' => [
        'class' => 'user-registration-form',
        'novalidate' => true
    ],
    'fields' => [
        [
            'type' => 'text',
            'name' => 'first_name',
            'label' => 'First Name',
            'placeholder' => 'John',
            'validation' => 'required|string|max:50'
        ],
        [
            'type' => 'text',
            'name' => 'last_name',
            'label' => 'Last Name',
            'placeholder' => 'Doe',
            'validation' => 'required|string|max:50'
        ],
        [
            'type' => 'email',
            'name' => 'email',
            'label' => 'Email Address',
            'placeholder' => 'john@example.com',
            'validation' => 'required|email|unique:users'
        ],
        [
            'type' => 'password',
            'name' => 'password',
            'label' => 'Password',
            'validation' => 'required|min:8|confirmed'
        ],
        [
            'type' => 'password',
            'name' => 'password_confirmation',
            'label' => 'Confirm Password'
        ],
        [
            'type' => 'select',
            'name' => 'country',
            'label' => 'Country',
            'options' => [
                'id' => 'Indonesia',
                'ph' => 'Philippines',
                'my' => 'Malaysia',
                'sg' => 'Singapore'
            ],
            'default' => 'id',
            'validation' => 'required|in:id,ph,my,sg'
        ],
        [
            'type' => 'date',
            'name' => 'birth_date',
            'label' => 'Date of Birth',
            'validation' => 'required|date|before:today'
        ],
        [
            'type' => 'checkbox',
            'name' => 'agree_terms',
            'label' => 'Terms',
            'checkbox_label' => 'I agree to the Terms of Service',
            'validation' => 'required'
        ]
    ],
    'buttons' => [
        [
            'type' => 'submit',
            'label' => 'Create Account'
        ]
    ]
];

$registrationForm = FormBuilder::fromArray($userRegistrationConfig);

// Get validation rules for your controller
$validationRules = $registrationForm->getValidationRules();
// Use: validator($request->all(), $validationRules)->validate();

echo "Registration Form:\n";
echo $registrationForm->render();
echo "\n\n";

// ============================================================================
// Example 3: Product Form with Grouped Fields
// ============================================================================

$productFormConfig = [
    'action' => '/products/store',
    'method' => 'POST',
    'attributes' => ['enctype' => 'multipart/form-data'],
    'fields' => [
        [
            'type' => 'text',
            'name' => 'name',
            'label' => 'Product Name',
            'validation' => 'required|string|max:255'
        ],
        [
            'type' => 'textarea',
            'name' => 'description',
            'label' => 'Description',
            'rows' => 4,
            'validation' => 'required|string|max:1000'
        ],
        [
            'type' => 'group',
            'label' => 'Pricing',
            'fields' => [
                [
                    'type' => 'number',
                    'name' => 'cost',
                    'label' => 'Cost Price',
                    'validation' => 'required|numeric|min:0'
                ],
                [
                    'type' => 'number',
                    'name' => 'selling_price',
                    'label' => 'Selling Price',
                    'validation' => 'required|numeric|min:0'
                ]
            ]
        ],
        [
            'type' => 'group',
            'label' => 'Inventory',
            'fields' => [
                [
                    'type' => 'number',
                    'name' => 'stock_quantity',
                    'label' => 'Stock Quantity',
                    'validation' => 'required|integer|min:0'
                ],
                [
                    'type' => 'number',
                    'name' => 'min_stock',
                    'label' => 'Minimum Stock Level',
                    'validation' => 'required|integer|min:0'
                ]
            ]
        ],
        [
            'type' => 'select',
            'name' => 'category',
            'label' => 'Category',
            'options' => [
                'electronics' => 'Electronics',
                'clothing' => 'Clothing',
                'food' => 'Food & Beverages',
                'other' => 'Other'
            ],
            'validation' => 'required|in:electronics,clothing,food,other'
        ],
        [
            'type' => 'file',
            'name' => 'image',
            'label' => 'Product Image',
            'accept' => 'image/*',
            'validation' => 'nullable|image|max:2048'
        ],
        [
            'type' => 'checkbox',
            'name' => 'is_active',
            'label' => 'Status',
            'checkbox_label' => 'Available for sale',
            'default' => true
        ]
    ],
    'buttons' => [
        [
            'type' => 'submit',
            'label' => 'Save Product'
        ],
        [
            'type' => 'reset',
            'label' => 'Clear'
        ]
    ]
];

$productForm = FormBuilder::fromArray($productFormConfig);
echo "Product Form:\n";
echo $productForm->render();
echo "\n\n";

// ============================================================================
// Example 4: Survey Form with Radio and Multi-select
// ============================================================================

$surveyFormConfig = [
    'action' => '/survey/submit',
    'method' => 'POST',
    'fields' => [
        [
            'type' => 'text',
            'name' => 'name',
            'label' => 'Your Name',
            'validation' => 'required|string'
        ],
        [
            'type' => 'radio',
            'name' => 'satisfaction',
            'label' => 'How satisfied are you with our service?',
            'options' => [
                'very_satisfied' => 'Very Satisfied',
                'satisfied' => 'Satisfied',
                'neutral' => 'Neutral',
                'unsatisfied' => 'Unsatisfied'
            ],
            'validation' => 'required|in:very_satisfied,satisfied,neutral,unsatisfied'
        ],
        [
            'type' => 'radio',
            'name' => 'would_recommend',
            'label' => 'Would you recommend us to a friend?',
            'options' => [
                'yes' => 'Yes',
                'maybe' => 'Maybe',
                'no' => 'No'
            ],
            'validation' => 'required|in:yes,maybe,no'
        ],
        [
            'type' => 'textarea',
            'name' => 'feedback',
            'label' => 'Your Feedback',
            'placeholder' => 'Please share any additional feedback...',
            'rows' => 4,
            'validation' => 'nullable|string|max:500'
        ]
    ],
    'buttons' => [
        [
            'type' => 'submit',
            'label' => 'Submit Survey'
        ]
    ]
];

$surveyForm = FormBuilder::fromArray($surveyFormConfig);
echo "Survey Form:\n";
echo $surveyForm->render();
echo "\n\n";

// ============================================================================
// Example 5: JSON Configuration (can be stored in database or JSON files)
// ============================================================================

$jsonConfig = <<<'JSON'
{
    "action": "/feedback/submit",
    "method": "POST",
    "fields": [
        {
            "type": "email",
            "name": "email",
            "label": "Email",
            "validation": "required|email"
        },
        {
            "type": "textarea",
            "name": "feedback",
            "label": "Your Feedback",
            "rows": 5,
            "validation": "required|string|max:1000"
        }
    ]
}
JSON;

$feedbackForm = FormBuilder::fromJson($jsonConfig);
echo "Feedback Form (from JSON):\n";
echo $feedbackForm->render();
echo "\n\n";

// ============================================================================
// Example 6: Export Form Configuration
// ============================================================================

// Convert back to array
$formArray = $registrationForm->toArray();
echo "Exported to Array:\n";
print_r($formArray);
echo "\n";

// Convert to JSON (useful for storing in database)
$formJson = $registrationForm->toJson(JSON_PRETTY_PRINT);
echo "Exported to JSON:\n";
echo $formJson;
echo "\n\n";

// ============================================================================
// Example 7: Using Fluent API (Existing method still works)
// ============================================================================

$flucentForm = FormBuilder::fromArray([
    'action' => '/test',
    'fields' => []
])
    ->text('username', 'Username', ['placeholder' => 'Choose a username'])
    ->email('email', 'Email')
    ->password('password', 'Password')
    ->checkbox('remember', 'Remember Me', ['checkbox_label' => 'Remember me on this computer'])
    ->submit('Login');

echo "Fluent API Form:\n";
echo $flucentForm->render();
echo "\n";
