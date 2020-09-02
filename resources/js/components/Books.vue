<template>
  <div class="flex flex-col shadow">
    <input
      type="search"
      name="search"
      id="search"
      @change="fetch"
      v-model="search"
      placeholder="Search By ISBN, Author or Book Name"
      class="w-full sm:w-2/12 my-2 self-end py-2 px-4 border text-sm font-medium rounded-md focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700"
    />
    <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
      <div
        class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200"
      >
        <table class="min-w-full divide-y divide-gray-200">
          <thead>
            <tr>
              <th
                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
              >Name</th>
              <th
                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
              >Authors</th>
              <th
                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
              >Status</th>
              <th
                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
              >Count</th>
              <th class="px-6 py-3 border-b border-gray-200 bg-gray-50"></th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <tr v-for="book in books" :key="book.id">
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
                      :href="'/admin/books/'+book.id"
                      class="text-sm leading-5 font-medium text-gray-900"
                      v-text="book.title.slice(0,32)"
                    ></a>
                    <div class="text-sm leading-5 text-gray-500" v-text="book.isbn"></div>
                  </div>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                <div v-for="author in book.authors" :key="author.id">
                  <div class="text-sm leading-5 font-medium text-gray-900" v-text="author.name"></div>
                  <div class="text-sm leading-5 text-gray-500" v-text="author.email"></div>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                <span
                  v-if="book.count > 20"
                  class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800"
                >Available</span>
                <span
                  v-else
                  class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800"
                >Low Count</span>
              </td>
              <td
                class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500"
                title="Book Available Count"
                v-text="book.count"
              ></td>
              <td
                class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium"
              >
                <div class="flex flex-col justify-center items-center text-center gap-1">
                  <a
                    :href="'/admin/books/'+book.id+'/edit'"
                    class="w-32 text-sm capitalize py-2 px-4 rounded bg-indigo-800 text-indigo-100"
                  >Edit Details</a>
                  <button
                    v-if="book.deleted_at === null"
                    class="w-32 text-sm capitalize py-2 px-4 rounded bg-red-800 text-red-100"
                    @click="deleteBook(book)"
                  >Delete</button>
                </div>
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
          >Previous</a>
          <a
            :href="links.next"
            v-show="links.last_page != links.current_page"
            @click.prevent="fetch(++links.current_page)"
            class="px-4 py-2 m-2 border rounded bg-indigo-500 text-white cursor-pointer"
          >Next</a>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      books: {},
      links: {},
      search: "",
    };
  },
  created() {
    this.fetch();
  },
  methods: {
    fetch(page) {
      axios.get(this.url(page)).then(this.refresh);
    },
    url(page) {
      if (!page || isNaN(page)) {
        let query = location.search.match(/page=(\d+)/);
        page = query ? query[1] : 1;
      }
      if (this.search) {
        return "/api/admin/books?page=" + page + "&search=" + this.search;
      }
      return "/api/admin/books?page=" + page;
    },
    refresh({ data }) {
      this.books = data.data;
      this.links = data.meta;
    },
    deleteBook(book) {
      if (confirm("Are you sure to delete book?")) {
        axios
          .delete("/admin/books/" + book.id)
          .then((response) => {
            this.books = this.books.filter((item) => {
              return item.id !== book.id;
            });
          })
          .catch((err) => {
            console.error(err.response);
          });
      }
    },
  },
};
</script>

<style>
</style>