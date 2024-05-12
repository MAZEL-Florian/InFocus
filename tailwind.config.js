import preset from './vendor/filament/support/tailwind.config.preset'

export default {
    presets: [preset],
    content: [
        './app/Filament/**/*.php',
        './resources/views/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
    ],
    theme: {
        colors: {
            'infocus-primary': "#03091d"
        },
        extend: {},
    },
    plugins: [
        require('flowbite/plugin')
    ],
}


