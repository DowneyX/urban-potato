<div class="container mx-auto">
  <section class="relative py-16 bg-blueGray-50">
    <div class="w-full mb-12 px-4">
      <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded bg-gray-900">
        <div class="rounded-t mb-0 px-2 py-3 border-0">
          <div class="flex flex-wrap items-center">
            <div class="relative w-full px-4 max-w-full flex-grow flex-1">
              <h3 class="inline font-semibold text-lg text-white">Courses</h3>
            </div>
            <a href=<?= $this->getUrlFor("adminCreateCourse") ?>>
              <div
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded text-sm px-5 py-2.5 mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                <p>
                  create course
                </p>
              </div>
            </a>
          </div>
        </div>
        <div class="block w-full overflow-x-auto">
          <table class="items-center w-full bg-transparent border-collapse">
            <thead>
              <tr>
                <th
                  class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-gray-800 text-white border-gray-800">
                  ID
                </th>
                <th
                  class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-gray-800 text-white border-gray-800">
                  course name
                </th>
                <th
                  class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-gray-800 text-white border-gray-800">
                  year
                </th>
                <th
                  class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-gray-800 text-white border-gray-800">
                  examinor_id
                </th>
                <th
                  class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-gray-800 text-white border-gray-800">
                  options
                </th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($params["courses"] as $course) {
                include("AdminTableCoursesRow.php");
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>
</div>