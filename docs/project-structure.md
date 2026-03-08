# SaaS Help Desk Structure (Suggested)

```text
app/
  Http/
    Controllers/
      Admin/
      Atendimento/
      Financeiro/
      Api/
    Requests/
  Models/
  Policies/

database/
  migrations/
  seeders/

resources/
  views/
    admin/
    atendimento/
    financeiro/

routes/
  web.php
  api.php
```

## Module Responsibilities

- `Admin`: tenant/client management, plans, subscriptions.
- `Financeiro`: invoices, payment lifecycle, service invoices (NFS-e integration ready).
- `Atendimento`: agents, end customers, tickets and chat messages.
- `Api`: integration endpoints for future frontend/mobile or external systems.
- `Policies`: tenant-level access control and admin-level permissions.
- `Requests`: validation rules centralized per action.
