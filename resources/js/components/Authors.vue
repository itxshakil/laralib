<template>
  <div class="flex flex-col shadow">
    <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
      <div
        class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200"
      >
        <table class="min-w-full divide-y divide-gray-200">
          <thead>
            <tr>
              <th
                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
              >
                Name
              </th>
              <th
                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
              >
                Introduction
              </th>
              <th
                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
              >
                Status
              </th>
              <th class="px-6 py-3 border-b border-gray-200 bg-gray-50"></th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <tr v-for="author in authors" :key="author.id">
              <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                <div class="flex items-center">
                  <div class="flex-shrink-0 h-10 w-10">
                    <img
                      class="h-10 w-10 rounded-full"
                      src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=4&amp;w=256&amp;h=256&amp;q=60"
                      alt
                    />
                  </div>
                  <div class="ml-4">
                    <a
                      :href="'/admin/authors/' + author.id"
                      class="text-sm leading-5 font-medium text-gray-900"
                      v-text="author.name"
                    ></a>
                    <div
                      class="text-sm leading-5 text-gray-500"
                      v-text="author.email"
                    ></div>
                  </div>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                <div
                  class="text-sm leading-5 text-gray-900"
                  v-text="
                    author.introduction
                      ? author.introduction.slice(0, 50)
                      : null
                  "
                ></div>
              </td>
              <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                <span
                  class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800"
                  v-if="author.email_verified_at"
                  >Verified</span
                >
                <span
                  class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800"
                  v-else
                  >Unverified</span
                >
              </td>
              <td
                class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium"
              >
                <a
                  :href="'/admin/authors/' + author.id + '/edit'"
                  class="text-indigo-600 hover:text-indigo-900"
                  >Edit</a
                >
              </td>
            </tr>
          </tbody>
        </table>
        <div class="flex rounded justify-center items-center">
          <a
            :href="links.prev"
            v-show="links.current_page !== 1"
            @click.prevent="fetch(--links.current_page)"
            class="px-4 py-2 m-2 border rounded bg-indigo-500 text-white cursor-pointer"
            >Previous</a
          >
          <a
            :href="links.next"
            v-show="links.last_page != links.current_page"
            @click.prevent="fetch(++links.current_page)"
            class="px-4 py-2 m-2 border rounded bg-indigo-500 text-white cursor-pointer"
            >Next</a
          >
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      authors: {},
      links: {},
    };
  },
  created() {
    this.fetch();
  },
  methods: {
    fetch(page) {
      flash("loading authors, okease wait.", "warning");
      axios.get(this.url(page)).then(this.refresh);
    },
    url(page) {
      if (!page) {
        let query = location.search.match(/page=(\d+)/);
        page = query ? query[1] : 1;
      }
      return "/api/admin/authors?page=" + page;
    },
    refresh({ data }) {
      this.authors = data.data;
      this.links = data.meta;
    },
  },
};
</script>
<style>
</style>