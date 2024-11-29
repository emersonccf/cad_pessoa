@echo off
php artisan db:seed --class=UserSeeder --env=testing
php artisan db:seed --class=StatusSeeder --env=testing
php artisan db:seed --class=TipoPessoaSeeder --env=testing
php artisan db:seed --class=PessoaSeeder --env=testing
php artisan db:seed --class=PessoaTipoSeeder --env=testing
php artisan db:seed --class=PessoaFisicaSeeder --env=testing
php artisan db:seed --class=ClientePessoaFisicaSeeder --env=testing
php artisan db:seed --class=FuncionarioSeeder --env=testing
php artisan db:seed --class=MedicoSeeder --env=testing
php artisan db:seed --class=VendedorSeeder --env=testing
php artisan db:seed --class=PessoaJuridicaSeeder --env=testing
php artisan db:seed --class=ClientePessoaJuridicaSeeder --env=testing
php artisan db:seed --class=FornecedorSeeder --env=testing
php artisan db:seed --class=DistribuidorSeeder --env=testing
