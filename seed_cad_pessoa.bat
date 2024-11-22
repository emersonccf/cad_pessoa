@echo off
php artisan db:seed --class=UserSeeder
php artisan db:seed --class=StatusSeeder
php artisan db:seed --class=TipoPessoaSeeder
php artisan db:seed --class=PessoaSeeder
php artisan db:seed --class=PessoaTipoSeeder
php artisan db:seed --class=PessoaFisicaSeeder
php artisan db:seed --class=ClientePessoaFisicaSeeder
php artisan db:seed --class=FuncionarioSeeder
php artisan db:seed --class=MedicoSeeder
php artisan db:seed --class=VendedorSeeder
php artisan db:seed --class=PessoaJuridicaSeeder
php artisan db:seed --class=ClientePessoaJuridicaSeeder
php artisan db:seed --class=FornecedorSeeder
php artisan db:seed --class=DistribuidorSeeder
