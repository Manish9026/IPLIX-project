<?php
// Ensure $media and $class are defined
$url = $media['url'] ?? '';
$type = $media['type'] ?? '';
$attributes = '';

// Convert $mediaAttributes to HTML attribute string
if (!empty($mediaAttributes) && is_array($mediaAttributes)) {
    foreach ($mediaAttributes as $attr => $val) {
        // Render boolean attributes like autoplay, loop correctly
        if (is_bool($val)) {
            if ($val) $attributes .= " $attr";
        } else {
            $attributes .= " $attr=\"" . esc($val) . "\"";
        }
    }
}
?>

<?php if (str_starts_with($type, 'image')): ?>
    <img src="<?= esc($url) ?>" class="<?= esc($class) ?>" <?= $attributes ?> />
<?php elseif (str_starts_with($type, 'video')): ?>
    <video class="<?= esc($class) ?>" <?= $attributes ?>>
        <source src="<?= esc($url) ?>" type="<?= esc($type) ?>">
        Your browser does not support the video tag.
    </video>
<?php endif; ?>
