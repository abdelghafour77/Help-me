<x-home-layout>
    <div class="bg-white dark:bg-gray-900 pt-14 min-h-screen ">

        <div class="flex flex-col p-2 py-6 m-h-screen max-w-screen-lg px-4 mx-auto lg:grid-cols-12 ">

            <form method="POST" action="">
                @csrf
                <div class="mb-6">
                    <label class="block">
                        <span class="text-gray-700 dark:text-white">Title</span>
                        <input type="text" name="title"
                            class="@error('title') border-red-500 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="" value="{{ old('title') }}" />
                    </label>
                    @error('title')
                        <div class="text-sm text-red-600">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-6">
                    <label for="exampletags" class="inline-block mb-2">Tags</label>
                    <input type="text" name="tags" id="tags" value="Tags1, Tags2"
                        class="tagify w-full leading-5 relative text-sm py-2 px-4 rounded text-gray-800 bg-white border border-gray-300 overflow-x-auto focus:outline-none focus:border-gray-400 focus:ring-0 dark:text-gray-300 dark:bg-gray-700 dark:border-gray-700 dark:focus:border-gray-600" id="exampletags"
                        minlength="2">
                </div>
                <div class="mb-6">
                    <label class="block">
                        <span class="text-gray-700 dark:text-white">Description</span>
                        <x-forms.tinymce-editor />
                    </label>
                    @error('description')
                        <div class="text-sm text-red-600">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="text-white bg-blue-600  rounded text-sm px-5 py-2.5">Submit</button>

            </form>

        </div>

    </div>
    <script>
        var whitelist = ["temple", "stun", "detective", "sign", "passion", "routine", "deck", "discriminate", "relaxation", "fraud", "attractive", "soft", "forecast", "point", "thank", "stage", "eliminate", "effective", "flood", "passive", "skilled", "separation", "contact", "compromise", "reality", "district",
            "nationalist", "leg", "porter", "conviction", "worker", "vegetable", "commerce", "conception", "particle", "honor", "stick", "tail", "pumpkin", "core", "mouse", "egg", "population", "unique", "behavior", "onion", "disaster", "cute", "pipe", "sock", "dialect", "horse", "swear", "owner", "cope", "global",
            "improvement", "artist", "shed", "constant", "bond", "brink", "shower", "spot", "inject", "bowel", "homosexual", "trust", "exclude", "tough", "sickness", "prevalence", "sister", "resolution", "cattle", "cultural", "innocent", "burial", "bundle", "thaw", "respectable", "thirsty", "exposure", "team", "creed",
            "facade", "calendar", "filter", "utter", "dominate", "predator", "discover", "theorist", "hospitality", "damage", "woman", "rub", "crop", "unpleasant", "halt", "inch", "birthday", "lack", "throne", "maximum", "pause", "digress", "fossil", "policy", "instrument", "trunk", "frame", "measure", "hall",
            "support", "convenience", "house", "partnership", "inspector", "looting", "ranch", "asset", "rally", "explicit", "leak", "monarch", "ethics", "applied", "aviation", "dentist", "great", "ethnic", "sodium", "truth", "constellation", "lease", "guide", "break", "conclusion", "button", "recording", "horizon",
            "council", "paradox", "bride", "weigh", "like", "noble", "transition", "accumulation", "arrow", "stitch", "academy", "glimpse", "case", "researcher", "constitutional", "notion", "bathroom", "revolutionary", "soldier", "vehicle", "betray", "gear", "pan", "quarter", "embarrassment", "golf", "shark",
            "constitution", "club", "college", "duty", "eaux", "know", "collection", "burst", "fun", "animal", "expectation", "persist", "insure", "tick", "account", "initiative", "tourist", "member", "example", "plant", "river", "ratio", "view", "coast", "latest", "invite", "help", "falsify", "allocation", "degree",
            "feel", "resort", "means", "excuse", "injury", "pupil", "shaft", "allow", "ton", "tube", "dress", "speaker", "double", "theater", "opposed", "holiday", "screw", "cutting", "picture", "laborer", "conservation", "kneel", "miracle", "brand", "nomination", "characteristic", "referral", "carbon", "valley",
            "hot", "climb", "wrestle", "motorist", "update", "loot", "mosquito", "delivery", "eagle", "guideline", "hurt", "feedback", "finish", "traffic", "competence", "serve", "archive", "feeling", "hope", "seal", "ear", "oven", "vote", "ballot", "study", "negative", "declaration", "particular", "pattern", "suburb",
            "intervention", "brake", "frequency", "drink", "affair", "contemporary", "prince", "dry", "mole", "lazy", "undermine", "radio", "legislation", "circumstance", "bear", "left", "pony", "industry", "mastermind", "criticism", "sheep", "failure", "chain", "depressed", "launch", "script", "green", "weave",
            "please", "surprise", "doctor", "revive", "banquet", "belong", "correction", "door", "image", "integrity", "intermediate", "sense", "formal", "cane", "gloom", "toast", "pension", "exception", "prey", "random", "nose", "predict", "needle", "satisfaction", "establish", "fit", "vigorous", "urgency", "X-ray",
            "equinox", "variety", "proclaim", "conceive", "bulb", "vegetarian", "available", "stake", "publicity", "strikebreaker", "portrait", "sink", "frog", "ruin", "studio", "match", "electron", "captain", "channel", "navy", "set", "recommend", "appoint", "liberal", "missile", "sample", "result", "poor", "efflux",
            "glance", "timetable", "advertise", "personality", "aunt", "dog"
        ]

        var input = document.querySelector('input[name=tags]'),
            tagify = new Tagify(input, {
                pattern: /^.{0,20}$/, // validate typed tag(s) by Regex. Here maximum chars length is defined as "20"
                delimiters: ",| ", // add new tags when a comma or a space character is entered
                trim: false, // if "delimiters" setting is using space as a delimeter, then "trim" should be set to "false"
                keepInvalidTags: true, // do not remove invalid tags (but keep them marked as invalid)
                editTags: 1, // single click to edit a tag
                maxTags: 6,
                blacklist: ["foo", "bar", "baz"],
                whitelist: whitelist,
                transformTag: transformTag,
                backspace: "edit",
                placeholder: "Type something",
                dropdown: {
                    enabled: 1, // show suggestion after 1 typed character
                    fuzzySearch: false, // match only suggestions that starts with the typed characters
                    position: 'text', // position suggestions list next to typed text
                    caseSensitive: true, // allow adding duplicate items if their case is different
                },
                templates: {
                    dropdownItemNoMatch: function(data) {
                        return `<div class='${this.settings.classNames.dropdownItem}' tabindex="0" role="option">
                    No suggestion found for: <strong>${data.value}</strong>
                </div>`
                    }
                }
            })

        // generate a random color (in HSL format, which I like to use)
        function getRandomColor() {
            function rand(min, max) {
                return min + Math.random() * (max - min);
            }

            var h = rand(1, 360) | 0,
                s = rand(40, 70) | 0,
                l = rand(65, 72) | 0;

            return 'hsl(' + h + ',' + s + '%,' + l + '%)';
        }

        function transformTag(tagData) {
            tagData.style = "--tag-bg:" + getRandomColor();

            if (tagData.value.toLowerCase() == 'shit')
                tagData.value = 's✲✲t'
        }

        tagify.on('add', function(e) {
            console.log(e.detail)
        })

        tagify.on('invalid', function(e) {
            console.log(e, e.detail);
        })
    </script>

    <x-head.tinymce-config />


</x-home-layout>
