@echo off
php artisan test --filter=PessoaUnidadeTest
php artisan test --filter=PessoaFuncionalidadesTest
php artisan test --filter=PessoaValidacaoFuncionalidadesTest
