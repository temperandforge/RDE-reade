module.exports = {
   plugins: [
      require('tailwindcss'),
      process.env.NODE_ENV === 'production' ? require('autoprefixer') : null,
      process.env.NODE_ENV === 'production'
         ? cssnano({ preset: 'default' })
         : cssnano({ preset: 'default' }),
      purgecss({
         content: [
            './*.php', 
            './template-parts/**/*.php', 
            './templates/**/*.php', 
            './src/components/**/*.svelte'
         ],
         defaultExtractor: content => content.match(/[\w-/:]+(?<!:)/g) || []
      })
   ]
}
