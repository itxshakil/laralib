module.exports = {
  purge: {
    // enabled: true,
    content: [
      "app/**/*.php",
      "resources/**/*.html",
      "resources/**/*.js",
      "resources/**/*.jsx",
      "resources/**/*.ts",
      "resources/**/*.tsx",
      "resources/**/*.php",
      "resources/**/*.vue",
      "resources/**/*.twig",
    ],
    options: {
      // defaultExtractor: (content) => content.match(/[\w-/.:]+(?<!:)/g) || [],
      whitelist: ['hidden' ,'sm:flex-1', 'sm:flex', 'sm:items-center', 'sm:justify-between'],
      whitelistPatterns: [/-active$/, /-enter$/, /-leave-to$/, /show$/],
    }
  },
  theme: {
    extend: {},
  },
  variants: {},
  plugins: [],
}
