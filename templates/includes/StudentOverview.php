<div class="grid grid-cols-2 gap-4 container mx-auto">
    <section class=" bg-blueGray-50 my-5">
        <h2>inschrijvingen</h2>
        <div class="w-full mb-12">
            <div class="relative my-2 flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded bg-gray-900">
                <div class="rounded-t mb-0 px-2 py-3 border-0">
                    <div class="flex flex-wrap items-center">
                        <div class="relative w-full px-4 max-w-full flex-grow flex-1">
                            <h3 class="inline font-semibold text-lg text-white">inschrijvingen</h3>
                        </div>
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
                                    examinator email
                                </th>
                                <th
                                    class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-gray-800 text-white border-gray-800">
                                    cursus naam
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($data as $value) {
                                include("StudentOverviewEnrollmentRow.php");
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <div class="mx-auto w-full my-5 container bg-white">
        <h2>cijfers</h2>
        <ul class="flex flex-col">
            <?php
            foreach ($data as $value) {
                if ($value["enrollment"]->getGrade() == null) {
                    continue;
                }
                include("StudentOverviewGradeCard.php");
            }
            ?>
        </ul>
    </div>
</div>