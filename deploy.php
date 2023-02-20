<?php

namespace Deployer;

require 'recipe/laravel.php';

// Config

set('repository', 'git@github.com:BasirRahimi/ProjectOrange.git');
set('ssh_multiplexing', false);
set('keep_releases', 3);

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

task('deploy:assets', function() {
    // run('sudo systemctl stop mysql');
    run('cd {{release_or_current_path}} && npm install');
    run('cd {{release_or_current_path}} && npm run build');
    // run('sudo systemctl start mysql');
});

task('deploy', [
    'deploy:prepare',
    'deploy:vendors',
    'deploy:assets',
    'artisan:storage:link',
    'artisan:config:cache',
    'artisan:route:cache',
    'artisan:view:cache',
    'artisan:event:cache',
    'artisan:migrate',
    'deploy:publish',
]);