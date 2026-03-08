# Chat Atendimento SaaS

SaaS platform for online support (Help Desk) with client management, plans, subscriptions, monthly billing, and service invoice structure (NFS-e ready).

## Tech Stack

- Laravel 12
- PHP 8.4
- Breeze (Blade + Tailwind)
- Eloquent ORM
- Migrations + Seeders
- SQLite (default dev) or MySQL (production)

## Modules

- `Admin`
	- Client companies
	- Plans
	- Subscriptions
- `Financeiro`
	- Invoices
	- Service invoice records (future NFS-e integration)
- `Atendimento`
	- Agents
	- End customers
	- Tickets and chat messages
- `Api`
	- REST endpoints for integration and future frontends

## Domain Coverage

Implemented entities:

- `cliente_empresas`
- `planos`
- `assinaturas`
- `faturas`
- `notas_fiscais`
- `atendentes`
- `clientes_finais`
- `chamados`
- `mensagem_chamados`
- `avaliacao_chamados`

Also implemented:

- Form Requests for validation
- Policies for access control (admin/tenant)
- Web routes and API routes (`/api/v1`)
- Blade views scaffold for main screens

## Local Setup

1. Install dependencies:

```bash
composer install
npm install
```

2. Environment and app key:

```bash
cp .env.example .env
php artisan key:generate
```

3. Database:

For SQLite (default):

```bash
touch database/database.sqlite
```

4. Run migrations + seeders:

```bash
php artisan migrate:fresh --seed
```

5. Start app:

```bash
php artisan serve
npm run dev
```

## Demo Credentials

After seed:

- Admin
	- Email: `admin@helpdesk-saas.test`
	- Password: `password`
- Tenant manager (demo company)
	- Email: `manager@acme.test`
	- Password: `password`

## Testing

Run all tests:

```bash
php artisan test
```

## Project Structure

See `docs/project-structure.md` for module organization and folder conventions.

## Next Steps

- Complete create/edit Blade forms with full UX
- Add payment gateway adapters (Asaas, Stripe, Mercado Pago)
- Implement automated NFS-e issuance flow after paid invoices
- Add queue jobs and notifications for billing lifecycle
