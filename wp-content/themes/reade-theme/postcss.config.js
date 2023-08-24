const purgecss = require('@fullhuman/postcss-purgecss')
const cssnano = require('cssnano')
module.exports = {
  plugins: [//{
    // tailwindcss: {},
    // autoprefixer: {},
    // // cssnext: {},
    // ...(process.env.NODE_ENV === 'production' ? { cssnano: {} } : {})
    require('tailwindcss'),
    require('autoprefixer'),
    // process.env.NODE_ENV === 'production' ? require('autoprefixer') : null,
    // process.env.NODE_ENV === 'production'
    //   ? cssnano({ preset: 'default' })
    //   : null,
    cssnano({ preset: 'advanced' }),
    purgecss({ //TODO
      content: [ //match tailwind
        '**/*.php', './src/**/*.{html,js,scss,svelte}'
      ],
      defaultExtractor: content => content.match(/[\w-/:]+(?<!:)/g) || []
    })
  ],
}
