# Alerts

An Alert UI component is a user interface element used to communicate important information, warnings, or status updates to users within an application or website. It’s typically a non-intrusive, visually distinct message that informs users about something they need to know—such as a success, error, warning, or general notification—without necessarily requiring immediate action like a modal would.

## Examples

<div>
    <Alert body="Default alert" />
    <Alert variant="success" body="Data has been submitted successfully" />
    <Alert variant="error" body="Some error has occurred" />
    <Alert variant="warning" body="File size should not exceed 1MB" />
</div>

HTML:

```html
<Alert body="Default alert" />
<Alert variant="success" body="Data has been submitted successfully" />
<Alert variant="error" body="Some error has occurred" />
<Alert variant="warning" body="File size should not exceed 1MB" />
```

## Properties

### `Alert`

`body` - sets the text message of the Alert.

`id` - (optional), sets the id of the container.

`variant` - (optional), sets the variant of the Alert. Available values: `success`, `error`, `warning`, `info`, or custom. Default: `` (empty).

`timeout` - (optional), sets the timeout in seconds after which the Alert will be dismissed, property `show` set to `false`. Default: `null`, no timeout.

`show` - (optional), sets the visibility of the Alert. Default: `true`.

`dismissible` - (optional), shows the dismiss button of the Alert. Default: `true`.

`icon` - (optional), shows the icon for the Alert. Available if variant is not used or it is custom. Default: `bi-info-circle` (info icon).

## Events

### `Alert`

`(dismiss)` - Event that happens when the Alert is dismissed (closed).

