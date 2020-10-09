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
      whitelist: ['hidden', 'sm:flex-1', 'sm:flex', 'sm:items-center', 'sm:justify-between', 'bg-green-100', 'text-green-700', 'border-green-400', 'bg-yellow-100', 'text-yellow-700', 'border-yellow-400', 'bg-red-100', 'text-red-700', 'border-red-400'],
      whitelistPatterns: [/-active$/, /-enter$/, /-leave-to$/, /show$/],
    }
  },
  theme: {
    extend: {},
  },
  variants: {},
  plugins: [],
}
