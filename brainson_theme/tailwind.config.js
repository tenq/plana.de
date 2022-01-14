/*
 * Refer to ./node_modules/tailwindncss/stubs/defaultConfig.stub.js to
 * see inheritd configurationn
 *
 */
module.exports = {
    mode: 'jit',
    future: {
        removeDeprecatedGapUtilities: true,
        purgeLayersByDefault: true,
        defaultLineHeights: true,
        standardFontWeights: true,
    },
    experimental: {
        applyComplexClasses: true,
    },

    purge: [
        './templates/**/*.twig',
        './*.php',
        './assets/js/**/*.js',
        './formfactory/**/*.mustache',
        './formfactory/**/*.php',
        './dsgvo_toolkit/templates/**/*.twig',
        './assets/src/styles/components/**/*.pcss',
    ],

    theme: {
        screens: {
            xs: '30em', // 480px old $sm-size
            sm: '40em', // 640px
            md: '48em', // 768px  old $md-size
            lg: '64em', // 1024px old $lg-size
            xl: '80em', // 1280px
        },
        extend: {
            colors: {
                'prime': {
                    DEFAULT: 'var(--prime)',
                    '50': '#f7fafc', 
                    '100': '#eef5f9', 
                    '200': '#d6e5f0', 
                    '300': '#bdd5e7', 
                    '400': '#8bb6d5', 
                    '500': 'var(--prime)', // DEFAULT
                    '600': '#5087b0', 
                    '700': 'var(--prime-off)', 
                    '800': '#355a75', 
                    '900': '#2c4a60',
                },
                'red': '#CA0813',
                'grey': '#464646',
                'darkgrey': '#282828'
            },
            spacing: {
                px: '1px',
                '0': '0',
                '0.5': '0.125rem',
                '1': '0.25rem',
                '1.5': '0.375rem',
                '2': '0.5rem',
                '2.5': '0.625rem',
                '3': '0.75rem',
                '3.5': '0.875rem',
                '4': '1rem',
                '5': '1.25rem',
                '6': '1.5rem',
                '7': '1.75rem',
                '8': '2rem',
                '10': '2.5rem',
                '12': '3rem',
                '16': '4rem',
                '20': '5rem',
                '24': '6rem',
                '28': '7rem',
                '32': '8rem',
                '36': '9rem',
                '40': '10rem',
                '44': '11rem',
                '48': '12rem',
                '56': '14rem',
                '64': '16rem',
                '80': '20rem',
                '88': '22rem',
                '96': '24rem',
                '120': '30rem',
                '160': '40rem',
            },
            fontFamily: {
                sans: [
                    'system-ui',
                    '-apple-system',
                    'BlinkMacSystemFont',
                    '"Segoe UI"',
                    'Roboto',
                    '"Helvetica Neue"',
                    'Arial',
                    '"Noto Sans"',
                    'sans-serif',
                    '"Apple Color Emoji"',
                    '"Segoe UI Emoji"',
                    '"Segoe UI Symbol"',
                    '"Noto Color Emoji"',
                ],
                serif: ['Georgia', 'Cambria', '"Times New Roman"', 'Times', 'serif'],
                mono: ['Menlo', 'Monaco', 'Consolas', '"Liberation Mono"', '"Courier New"', 'monospace'],
            },
            fontSize: {
                xs: ['0.75rem', { lineHeight: '1rem' }],
                sm: ['0.875rem', { lineHeight: '1.25rem' }],
                base: ['1rem', { lineHeight: '1.5rem' }],
                lg: ['1.125rem', { lineHeight: '1.75rem' }],
                xl: ['1.25rem', { lineHeight: '1.75rem' }],
                '2xl': ['1.5rem', { lineHeight: '2rem' }],
                '3xl': ['1.875rem', { lineHeight: '2.25rem' }],
                '4xl': ['2.25rem', { lineHeight: '2.5rem' }],
                '5xl': ['3rem', { lineHeight: '1' }],
                '6xl': ['4rem', { lineHeight: '1' }],
            },
            fontWeight: {
                hairline: '100',
                thin: '200',
                light: '300',
                normal: '400',
                medium: '500',
                semibold: '600',
                bold: '700',
                extrabold: '800',
                black: '900',
            },
            maxHeight: {
                '0': '0',
                '112': '28rem',
                '136': '34rem'
            },
            maxWidth: (theme, { breakpoints }) => ({
                none: 'none',
                xs: '20rem',
                sm: '24rem',
                md: '28rem',
                lg: '32rem',
                xl: '36rem',
                '2xl': '42rem',
                '3xl': '48rem',
                '4xl': '56rem',
                '5xl': '64rem',
                '6xl': '70rem',
                '7xl': '76rem',
                full: '100%',
                'heading': '28ch',
                'list': '48ch',
                'copy': '75ch',
                'hero': '120rem',
                ...breakpoints(theme('screens')),
            }),
            zIndex: {
                '1': '1',
                '49': '49',
                '10000': '10000',
            },
            boxShadow: theme => ({
                xs: '0 0 0 1px rgba(0, 0, 0, 0.05)',
                sm: '0 1px 2px 0 rgba(0, 0, 0, 0.05)',
                default: '0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06)',
                md: '0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06)',
                lg: '0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05)',
                xl: '0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04)',
                '2xl': '0 25px 50px -12px rgba(0, 0, 0, 0.25)',
                inner: 'inset 0 2px 4px 0 rgba(0, 0, 0, 0.06)',
                outline: `0 0 0 3px ${theme('colors.blue.200')}`,
                none: 'none',
                box: '2px 4px 11px rgba(0, 0, 0, 0.12)',
                card: '2px 6px 10px rgba(0, 0, 0, 0.08)',
            }),
            inset: {
                '36': '9rem',
                '28': '7rem',
            },
        },

        customForms: theme => ({
            default: {
                input: {
                    borderRadius: '2px',
                    borderWidth: '1px',
                    borderColor: theme('colors.gray.400'),
                    '&:focus': {
                        boxShadow: theme('boxShadow.outline'),
                        borderColor: theme('colors.gray.400'),
                    }
                },
                select: {
                    icon: `<svg fill="${theme('colors.black')}" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>`,
                    borderRadius: '2px',
                    borderWidth: '1px',
                    borderColor: theme('colors.gray.400'),
                    '&:focus': {
                        boxShadow: theme('boxShadow.outline'),
                        borderColor: theme('colors.gray.400'),
                    },

                },
                textarea: {
                    borderRadius: '2px',
                    borderWidth: '1px',
                    borderColor: theme('colors.gray.400'),
                    '&:focus': {
                        boxShadow: theme('boxShadow.outline'),
                        borderColor: theme('colors.gray.400'),
                    }
                },
                checkbox: {
                    cursor: 'pointer',
                    borderWidth: '1px',
                    borderRadius: 0,
                    borderColor: theme('colors.gray.400'),
                    '&:focus': {
                        boxShadow: theme('boxShadow.outline'),
                        borderColor: theme('colors.gray.400'),
                    },
                    '&:checked': {
                        color: theme('colors.gray.800'),
                    },
                },
                radio: {
                    cursor: 'pointer',
                    borderWidth: '1px',
                    borderColor: theme('colors.gray.400'),
                    '&:focus': {
                        boxShadow: theme('boxShadow.outline'),
                        borderColor: theme('colors.gray.400'),
                    },
                    '&:checked': {
                        borderColor: theme('colors.gray.400'),
                    },
                },
            },
        }),
    },
    variants: {
        width: ['responsive', 'hover', 'focus'],
        boxShadow: ['responsive', 'hover', 'focus', 'active'],
    },
    corePlugins: {
        container: false,
    },
    plugins: [
        /*
         * Tailwind Typography Plugin
         * Provides great, customizable base styling for RTE content but adds
         * ~39 kb of CSS (uncompressed) to the minified bundle
         *
         * Further information -> https://github.com/tailwindlabs/tailwindcss-typography
         */
        // require('@tailwindcss/typography')({
        //     modifiers: ['lg'],
        // }),

        /*
         * Custom form styles
         * Further information -> https://github.com/tailwindlabs/tailwindcss-custom-forms
         */
        require('@tailwindcss/forms')({
            strategy: 'class',
        }),

        /*
         * Aspect ratio
         * Further information
         * -> https://github.com/tailwindlabs/tailwindcss-aspect-ratio#readme
         */
        require('@tailwindcss/aspect-ratio'),
    ],
}
