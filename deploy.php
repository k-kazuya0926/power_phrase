<?php
namespace Deployer;

require 'recipe/laravel.php';

// Project name
set('application', 'power_phrase');

// Project repository
set('repository', 'git@github.com:k-kazuya0926/power_phrase.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true); 

// Shared files/dirs between deploys 
add('shared_files', []);
add('shared_dirs', []);

// Writable dirs by web server 
add('writable_dirs', []);


// Hosts
// inventory('hosts.yml'); // これだとなぜかPermission deniedとなる
host('54.178.66.183')
    ->port(22)
    ->user('ec2-user')
    ->identityFile('~/.ssh/kazuya.pem')
    ->stage('production')
    ->set('branch', 'master')
    ->set('deploy_path', '/var/www/html/power_phrase');



// Tasks

task('build', function () {
    run('cd {{release_path}} && build');
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// shared/.envを.env.{stage}で上書きする
// after('deploy:shared', 'overwrite-env');

// Migrate database before symlink new release.

before('deploy:symlink', 'artisan:migrate');

// Tasks

task('deploy', function () {
    // 本番への反映は確認を挟む
    // if (input()->hasArgument('stage') && (input()->getArgument('stage') === 'production')) {
    //     if (!askConfirmation('productionに反映して問題ありませんか？', true)) {
    //         writeln('deploy was stopped');
    //         return;
    //     }
    // }
    invoke('deploy:laravel');
});

// desc('shared/.envを.env.{stage}で上書き');
// task('overwrite-env', function () {
//     $stage = get('stage');
//     $src = ".env.${stage}";
//     $deployPath = get('deploy_path');
//     $sharedPath = "${deployPath}/shared";
//     run("cp -f {{release_path}}/${src} ${sharedPath}/.env");
// });

/**
 * Main task
 */
desc('Deploy your project');
task('deploy:laravel', [
    'deploy:info',
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'deploy:update_code',
    'deploy:shared',
    'deploy:vendors',
    'deploy:writable',
    'artisan:storage:link',
    'artisan:view:clear',
    'artisan:cache:clear',
    'artisan:config:cache',
    'artisan:optimize',
    'deploy:symlink',
    'deploy:unlock',
    'cleanup',
]);