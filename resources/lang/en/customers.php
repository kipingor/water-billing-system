<?php

return [
    'title' => 'Customers',
    'list' => 'Customer List',
    'details' => 'Customer Details',
    'create' => 'Create Customer',
    'edit' => 'Edit Customer',
    'delete' => 'Delete Customer',
    'confirm_delete' => 'Are you sure you want to delete this customer?',

    'fields' => [
        'first_name' => 'First Name',
        'last_name' => 'Last Name',
        'email' => 'Email',
        'phone_number' => 'Phone Number',
        'idnumber' => 'ID Number',
        'physical_address' => 'Physical Address',
        'postal_address' => 'Postal Address',
        'account_number' => 'Account Number',
        'account_status' => 'Account Status',
    ],

    'account_status' => [
        'active' => 'Active',
        'inactive' => 'Inactive',
        'suspended' => 'Suspended',
    ],

    'messages' => [
        'created' => 'Customer created successfully.',
        'updated' => 'Customer updated successfully.',
        'deleted' => 'Customer deleted successfully.',
    ],

    'errors' => [
        'create_failed' => 'Failed to create customer. Please try again.',
        'update_failed' => 'Failed to update customer. Please try again.',
        'delete_failed' => 'Failed to delete customer. Please try again.',
    ],
];