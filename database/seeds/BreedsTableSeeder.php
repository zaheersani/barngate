<?php

use Illuminate\Database\Seeder;

class BreedsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('breeds')->truncate();
        
        
        /* CATTLE */

        $cattle = ["Angus", "Beefmaster", "Braford", "Brahman", "Brangus", "Braunvieh", "Charolais", 
                    "Corriente", "Crossbred Cattle", "Gelbvieh", "Hereford", "Irish Black",
                    "Jersey", "Limousin", "Longhorn", "Lowline", "Red Angus", "Red Brangus", "Santa Gertrudis", 
                    "Shorthorn", "Simmental", "Wagyu"];

        for ($i=0; $i <= count($cattle) - 1; $i++) {

            DB::table('breeds')->insert([
                "name" => $cattle[$i],
                "animal_id" => 1,
            ]);
        }


        /* HORSES */

        $horses = ["Quarter Horse", "Paint", "Draft", "Mule", 
                    "Thoroughbred", "Appaloosa", "Mustang", "Pony"];

        for ($i=0; $i <= count($horses) - 1; $i++) {

            DB::table('breeds')->insert([
                "name" => $horses[$i],
                "animal_id" => 2,
            ]);
        }



        /* SHEEP */


        $sheep = ["Blackbelly", "Black Welsh Mountain", "Bluefaced Leicester", "Border Cheviot", "Border Leicester", 
                    "Brecknock Hill Cheviot", "British Milk Sheep", "California Red", 
                    "California Variegated Mutant/Romeldale", "Canadian Arcott", "Charollais", "Clun Forest", "Columbia", "Coopworth", "Cormo", 
                    "Corriedale", "Cotswold", "Debouillet", "Dorper", "Dorset", "East Friesian", "Finnsheep", "Gulf Coast Native", "Hampshire", 
                    "Hog Island", "Icelandic", "Ile de France", "Jacob", "Karakul", "Katahdin", "Lacaune", "Leicester Longwool", "Lincoln Longwool", 
                    "Merino", "Montadale", "Navajo-Churro", "Newfoundland", "North Country Cheviot", "Oxford", "Panama", "Perendale", "Polypay", "Rambouillet", 
                    "Rideau Arcott", "Romanov", "Romney", "Royal White", "Santa Cruz", "Scottish Blackface", "Shetland", "Shropshire", "Soay", "Southdown", 
                    "St. Croix", "Suffolk", "Targhee", "Teeswater", "Texel", "Tunis", "Wensleydale", "Wiltshire Horn"];

        for ($i=0; $i <= count($sheep) - 1; $i++) {

            DB::table('breeds')->insert([
                "name" => $sheep[$i],
                "animal_id" => 3,
            ]);
        }



        /* GOAT */

        $goat = ["Alpine", "Angora", "Arapawa", "Boer", "Golden Guernsey", "Kiko", "Kinder", "LaMancha",
                    "Myotonic", "Nigerian Dwarf", "Nubian", "Oberhasli", "Pygmy", "Pygora", "Saanen and Sable",
                    "San Clemente", "Spanish", "Toggenburg"];

        for ($i=0; $i <= count($goat) - 1; $i++) {

            DB::table('breeds')->insert([
                "name" => $goat[$i],
                "animal_id" => 4,
            ]);
        }





         /* PIG */

         $pig = ["American Landrace", "American Yorkshire", "Berkshire", "Chester White", "Choctaw", "Duroc", 
                 "Gloucestershire Old Spot", "Guinea Hog", "Hampshire", "Hereford", "Lacombe", "Large Black", 
                 "Mulefoot", "Ossabaw Island", "Pietrain", "Poland China", "Red Wattle", "Spotted", "Tamworth", "Vietnamese Potbelly"];

        for ($i=0; $i <= count($pig) - 1; $i++) {

            DB::table('breeds')->insert([
                "name" => $pig[$i],
                "animal_id" => 5,
            ]);
        }



         /* DOGS */

        $dogs = ["Affenpinscher", "Afghan Hound", "Airedale Terrier", "Akbash", "Akita", "Alaskan Malamute", "American Bulldog", 
                 "American Eskimo Dog", "American Foxhound", "American Hairless Terrier", "American Staffordshire Terrier", 
                 "American Water Spaniel", "Anatolian Shepherd", "Appenzell Mountain Dog", "Australian Cattle Dog / Blue Heeler", 
                 "Australian Kelpie", "Australian Shepherd", "Australian Terrier", "Basenji", "Basset Hound", "Beagle", "Bearded Collie", 
                 "Beauceron", "Bedlington Terrier", "Belgian Shepherd / Laekenois", "Belgian Shepherd / Malinois", "Belgian Shepherd / Sheepdog",
                 "Belgian Shepherd / Tervuren", "Bernese Mountain Dog", "Bichon Frise", "Black and Tan Coonhound", "Black Labrador Retriever", 
                 "Black Mouth Cur", "Black Russian Terrier", "Bloodhound", "Blue Lacy", "Bluetick Coonhound", "Boerboel", "Bolognese", "Border Collie", 
                 "Border Terrier", "Borzoi", "Boston Terrier", "Bouvier des Flandres", "Boxer", "Boykin Spaniel", "Briard", "Brittany Spaniel", "Brussels Griffon", 
                 "Bull Terrier", "Bullmastiff", "Cairn Terrier", "Canaan Dog", "Cane Corso", "Cardigan Welsh Corgi", "Carolina Dog", "Catahoula Leopard Dog", 
                 "Cattle Dog", "Caucasian Sheepdog / Caucasian Ovtcharka", "Cavalier King Charles Spaniel", "Chesapeake Bay Retriever", "Chihuahua", "Chinese Crested Dog", 
                 "Chinese Foo Dog", "Chinook", "Chocolate Labrador Retriever", "Chow Chow", "Cirneco dell'Etna", "Clumber Spaniel", "Cockapoo", "Cocker Spaniel", 
                 "Collie", "Coonhound", "Corgi", "Coton de Tulear", "Curly-Coated Retriever", "Dachshund", "Dalmatian", "Dandie Dinmont Terrier", "Doberman Pinscher", 
                 "Dogo Argentino", "Dogue de Bordeaux", "Dutch Shepherd", "English Bulldog", "English Cocker Spaniel", "English Coonhound", "English Foxhound", 
                 "English Pointer", "English Setter", "English Shepherd", "English Springer Spaniel", "English Toy Spaniel", "Entlebucher", "Eskimo Dog", "Feist", 
                 "Field Spaniel", "Fila Brasileiro", "Finnish Lapphund", "Finnish Spitz", "Flat-Coated Retriever", "Fox Terrier", "Foxhound", "French Bulldog", 
                 "Galgo Spanish Greyhound", "German Pinscher", "German Shepherd Dog", "German Shorthaired Pointer", "German Spitz", "German Wirehaired Pointer", "Giant Schnauzer", 
                 "Glen of Imaal Terrier", "Golden Retriever", "Gordon Setter", "Great Dane", "Great Pyrenees", "Greater Swiss Mountain Dog", "Greyhound", "Hamiltonstovare", 
                 "Harrier", "Havanese", "Hound", "Hovawart", "Husky", "Ibizan Hound", "Icelandic Sheepdog", "Illyrian Sheepdog", "Irish Setter", "Irish Terrier", "Irish Water Spaniel", 
                 "Irish Wolfhound", "Italian Greyhound", "Jack Russell Terrier", "Japanese Chin", "Jindo", "Kai Dog", "Karelian Bear Dog", "Keeshond", "Kerry Blue Terrier", "Kishu", "Klee Kai", 
                 "Komondor", "Kuvasz", "Kyi Leo", "Labrador Retriever", "Lakeland Terrier", "Lancashire Heeler", "Leonberger", "Lhasa Apso", "Lowchen", "Maltese", "Manchester Terrier", "Maremma Sheepdog", 
                 "Mastiff", "McNab", "Miniature Bull Terrier", "Miniature Dachshund", "Miniature Pinscher", "Miniature Poodle", "Miniature Schnauzer", "Mixed Breed", "Mountain Cur", "Mountain Dog", 
                 "Munsterlander", "Neapolitan Mastiff", "New Guinea Singing Dog", "Newfoundland Dog", "Norfolk Terrier", "Norwegian Buhund", "Norwegian Elkhound", "Norwegian Lundehund", "Norwich Terrier", 
                 "Nova Scotia Duck Tolling Retriever", "Old English Sheepdog", "Otterhound", "Papillon", "Parson Russell Terrier", "Patterdale Terrier / Fell Terrier", "Pekingese", "Pembroke Welsh Corgi", 
                 "Peruvian Inca Orchid", "Petit Basset Griffon Vendeen", "Pharaoh Hound", "Pit Bull Terrier", "Plott Hound", "Pointer", "Polish Lowland Sheepdog", "Pomeranian", "Poodle", "Portuguese Podengo", 
                 "Portuguese Water Dog", "Presa Canario", "Pug", "Puli", "Pumi", "Pyrenean Shepherd", "Rat Terrier", "Redbone Coonhound", "Retriever", "Rhodesian Ridgeback", "Rottweiler", "Rough Collie", 
                 "Saint Bernard", "Saluki", "Samoyed", "Sarplaninac", "Schipperke", "Schnauzer", "Scottish Deerhound", "Scottish Terrier", "Sealyham Terrier", "Setter", "Shar-Pei", "Sheep Dog", "Shepherd", 
                 "Shetland Sheepdog / Sheltie", "Shiba Inu", "Shih Tzu", "Siberian Husky", "Silky Terrier", "Skye Terrier", "Sloughi", "Smooth Collie", "Smooth Fox Terrier", "South Russian Ovtcharka", "Spaniel", 
                 "Spanish Water Dog", "Spinone Italiano",  "Spitz", "Staffordshire Bull Terrier", "Standard Poodle", "Standard Schnauzer", "Sussex Spaniel", "Swedish Vallhund", "Terrier", "Thai Ridgeback", "Tibetan Mastiff", 
                 "Tibetan Spaniel", "Tibetan Terrier", "Tosa Inu", "Toy Fox Terrier", "Toy Manchester Terrier", "Treeing Walker Coonhound", "Vizsla", "Weimaraner", "Welsh Springer Spaniel", "Welsh Terrier", 
                 "West Highland White Terrier / Westie", "Wheaten Terrier", "Whippet", "White German Shepherd", "Wire Fox Terrier", "Wirehaired Dachshund", "Wirehaired Pointing Griffon", "Wirehaired Terrier", 
                 "Xoloitzcuintli / Mexican Hairless", "Yellow Labrador Retriever", "Yorkshire Terrier"];


        for ($i=0; $i <= count($dogs) - 1; $i++) {

            DB::table('breeds')->insert([
                "name" => $dogs[$i],
                "animal_id" => 6,
            ]);
        }




        /* CATS */

        $cats = ["American Bobtail", "American Curl", "American Shorthair", "American Wirehair", "Applehead Siamese", "Balinese", "Bengal", "Birman", "Bombay", "British Shorthair", "Burmese", "Burmilla", "Calico", 
                 "Canadian Hairless", "Chartreux", "Chausie", "Chinchilla", "Cornish Rex", "Cymric", "Devon Rex", "Dilute Calico", "Dilute Tortoiseshell", "Domestic Long Hair", "Domestic Medium Hair", "Domestic Short Hair", 
                 "Egyptian Mau", "Exotic Shorthair", "Extra-Toes Cat / Hemingway Polydactyl", "Havana", "Himalayan", "Japanese Bobtail", "Javanese", "Korat", "LaPerm", "Maine Coon", "Manx", "Munchkin", "Nebelung",
                 "Norwegian Forest Cat", "Ocicat", "Oriental Long Hair", "Oriental Short Hair", "Oriental Tabby", "Persian", "Pixiebob", "Ragamuffin", "Ragdoll", "Russian Blue", "Scottish Fold", "Selkirk Rex", "Siamese", 
                  "Siberian", "Silver", "Singapura", "Snowshoe", "Somali", "Sphynx / Hairless Cat", "Tabby", "Tiger", "Tonkinese", "Torbie", "Tortoiseshell", "Turkish Angora", "Turkish Van", "Tuxedo", "York Chocolate"];


        for ($i=0; $i <= count($cats) - 1; $i++) {

            DB::table('breeds')->insert([
                "name" => $cats[$i],
                "animal_id" => 7,
            ]);
        }



    }
}
