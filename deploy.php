<?php
namespace Deployer;

require 'recipe/laravel.php';

// Config

set('repository', 'git@github.com:BasirRahimi/ProjectOrange.git');
set('ssh_multiplexing', false);

add('shared_files', []);
add('shared_dirs', []);
add('writable_dirs', []);

// Hosts

host('157.245.39.48')
    ->set('remote_user', 'deployer')
    ->set('identity_file', '~/.ssh/projectorangedeployer')
    ->set('deploy_path', '/var/www/projectorange');

// Hooks

after('deploy:failed', 'deploy:unlock');
