---
currentMenu: operationsNotification
---

# Notification Operations

The SDK supprots mutating notifications that are available in your Lagoon instance.

## Mutations

### `add()`

Add a notification to Lagoon.

*Parameters `<array>`*

```php
$notification = [
  'name' => 'notification-name',
  'channel' => 'channel',
  'webhook' => 'http://webhook.url',
];
```

*Example*

```php
$client = new LagoonClient($endpoint, $token);
$client->notification()->add($notification)->execute();
```

### `addToProject()`

Update a project in Lagoon and attach a notification.

*Parameters `<array>`*

```php
$notification = [
  'notificationType' => 'SLACK',
  'project' => 'my-project',
  'notificationName' => 'notificatoin-name',
];
```

*Example*

```php
$client = new LagoonClient($endpoint, $token);
$client->notification()->addToProject($notification)->execute();
```
