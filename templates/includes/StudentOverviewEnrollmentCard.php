<li>
    <div class="py-5 px-4 flex justify-between bg-gray-900 rounded">
        <div class="sm:pl-4 pr-8 flex sm:items-center">
            <div class="space-y-1">
                <p class="text-base text-white font-bold tracking-wide">cursus ID</p>
                <p class="text-sm text-gray-300 font-medium">
                    <?= $value["course"]->getId() ?>
                </p>
            </div>
        </div>

        <div class="sm:pl-4 pr-8 flex sm:items-center">
            <div class="space-y-1">
                <p class="text-base text-white font-bold tracking-wide">cursus</p>
                <p class="text-sm text-gray-300 font-medium">
                    <?= $value["course"]->getCourseName() ?>
                </p>
            </div>
        </div>

        <div class="sm:pl-4 pr-8 flex sm:items-center">
            <div class="space-y-1">
                <p class="text-base text-white font-bold tracking-wide">jaar</p>
                <p class="text-sm text-gray-300 font-medium">
                    <?= $value["course"]->getYear() ?>
                </p>
            </div>
        </div>

        <div class="sm:pl-4 pr-8 flex sm:items-center">
            <div class="space-y-1">
                <p class="text-base text-white font-bold tracking-wide">examinator</p>
                <p class="text-sm text-gray-300 font-medium">
                    <?= $value["examinor"]->getEmail() ?>
                </p>
            </div>
        </div>
    </div>
</li>