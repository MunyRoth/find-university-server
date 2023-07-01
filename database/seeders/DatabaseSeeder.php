<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\MajorType;
use App\Models\Province;
use App\Models\UniversityType;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'name' => 'Admin',
            'email' => 'dr.munyroth@gmail.com',
            'role' => 'admin',
            'email_verified_at' => date(today()),
            'password' => bcrypt('admin@143272')
        ]);

        User::create([
            'name' => 'Admin',
            'email' => 'munyroth@gmail.com',
            'role' => 'user',
            'email_verified_at' => date(today()),
            'password' => bcrypt('user@1234')
        ]);

        Province::insert([
            ['name_km' => 'ភ្នំពេញ', 'name_en' => 'Phnom Penh'],
            ['name_km' => 'កណ្ដាល', 'name_en' => 'Kandal'],
            ['name_km' => 'កំពង់ចាម', 'name_en' => 'Kampong Cham'],
            ['name_km' => 'កំពង់ឆ្នាំង', 'name_en' => 'Kampong Chhnang'],
            ['name_km' => 'កំពង់ធំ', 'name_en' => 'Kampong Thom'],
            ['name_km' => 'កំពង់ស្ពឺ', 'name_en' => 'Kampong Speu'],
            ['name_km' => 'កំពត', 'name_en' => 'Kampot'],
            ['name_km' => 'កែប', 'name_en' => 'Kep'],
            ['name_km' => 'កោះកុង', 'name_en' => 'Koh Kong'],
            ['name_km' => 'ក្រចេះ', 'name_en' => 'Kratie'],
            ['name_km' => 'តាកែវ', 'name_en' => 'Takeo'],
            ['name_km' => 'ត្បូងឃ្មុំ', 'name_en' => 'Tboung Khmom'],
            ['name_km' => 'បន្ទាយមានជ័យ', 'name_en' => 'Banteay Meanchey'],
            ['name_km' => 'បាត់ដំបង', 'name_en' => 'Battambang'],
            ['name_km' => 'ប៉ៃលិន', 'name_en' => 'Pailin'],
            ['name_km' => 'ពោធិ៍សាត់', 'name_en' => 'Pursat'],
            ['name_km' => 'ព្រះវិហារ', 'name_en' => 'Preah Vihear'],
            ['name_km' => 'ព្រះសីហនុ', 'name_en' => 'Preah Sihanouk'],
            ['name_km' => 'ព្រៃវែង', 'name_en' => 'Prey Veng'],
            ['name_km' => 'មណ្ឌលគីរី', 'name_en' => 'Mondulkiri'],
            ['name_km' => 'រតនគីរី', 'name_en' => 'Ratanakiri'],
            ['name_km' => 'សៀមរាប', 'name_en' => 'Siem Reap'],
            ['name_km' => 'ស្ទឹងត្រែង', 'name_en' => 'Stung Treng'],
            ['name_km' => 'ស្វាយរៀង', 'name_en' => 'Svay Rieng'],
            ['name_km' => 'ឧត្តរមានជ័យ', 'name_en' => 'Oddar Meanchey']
            ]);

        UniversityType::insert([
            ['type_km' => 'រដ្ឋ', 'type_en' => 'Public'],
            ['type_km' => 'ឯកជន', 'type_en' => 'Private'],
        ]);

        MajorType::insert([
            ['name_km' => 'គណនីយ្យ', 'name_en' => 'Accounting'],
            ['name_km' => 'គណនេយ្យ និងសវនកម្ម', 'name_en' => 'Accounting and Auditing'],
//            ['name_km' => 'គណនី', 'name_en' => 'Administration'],
//            ['name_km' => 'គណនី', 'name_en' => 'Advertising'],
//            ['name_km' => 'គណនី', 'name_en' => 'African Studies'],
//            ['name_km' => 'គណនី', 'name_en' => 'Agribusiness'],
//            ['name_km' => 'គណនី', 'name_en' => 'Agricultural Economics'],
//            ['name_km' => 'គណនី', 'name_en' => 'Agricultural Education'],
//            ['name_km' => 'គណនី', 'name_en' => 'Agricultural Engineering'],
            ['name_km' => 'សេដ្ឋកិច្ចកសិកម្ម និងអភិវឌ្ឍន៍ជនបទ', 'name_en' => 'Agricultural Economics and Rural Development'],
//            ['name_km' => 'គណនី', 'name_en' => 'Agriculture'],
//            ['name_km' => 'គណនី', 'name_en' => 'American Studies'],
//            ['name_km' => 'គណនី', 'name_en' => 'Ancient Studies'],
            ['name_km' => 'វិទ្យាសាស្ត្រសត្វ', 'name_en' => 'Animal Science'],
//            ['name_km' => 'គណនី', 'name_en' => 'Anthropology'],
            ['name_km' => 'បុរាណវិទ្យា', 'name_en' => 'Archaeology'],
            ['name_km' => 'ស្ថាបត្យកម្ម', 'name_en' => 'Architecture'],
            ['name_km' => 'ស្ថាបត្យកម្ម និងនគរូបនីយកម្ម', 'name_en' => 'Architecture and Urbanization'],
            ['name_km' => 'តុបតែងលម្អស្ថាបត្យកម្ម', 'name_en' => 'Architectural Decoration'],
            ['name_km' => 'វិស្វកម្មស្ថាបត្យកម្ម', 'name_en' => 'Architectural Engineering'],
//            ['name_km' => 'គណនី', 'name_en' => 'Art and Design'],
//            ['name_km' => 'គណនី', 'name_en' => 'Aviation'],
//            ['name_km' => 'គណនី', 'name_en' => 'Art History'],
//            ['name_km' => 'គណនី', 'name_en' => 'Arts'],
//            ['name_km' => 'គណនី', 'name_en' => 'Asian Studies'],
//            ['name_km' => 'គណនី', 'name_en' => 'Astronomy'],
            ['name_km' => 'ក្សេត្រសាស្ត្រ', 'name_en' => 'Agronomy'],
            ['name_km' => 'កសិឧស្សាហកម្ម', 'name_en' => 'Agro-industry'],
            ['name_km' => 'វារីវប្បកម្ម', 'name_en' => 'Aquaculture'],
            ['name_km' => 'សវនកម្ម', 'name_en' => 'Auditing'],
            ['name_km' => 'ធនាគារ និងហិរញ្ញវត្ថុ', 'name_en' => 'Banking and Finance'],
//            ['name_km' => 'គណនី', 'name_en' => 'Biochemistry'],
//            ['name_km' => 'គណនី', 'name_en' => 'Biological Sciences'],
            ['name_km' => 'ជីវវិទ្យា', 'name_en' => 'Biology'],
            ['name_km' => 'វិស្វកម្មជីវសាស្ត្រ', 'name_en' => 'Biological Engineering'],
            ['name_km' => 'វិស្វកម្មសំណង់ស៊ីវិល', 'name_en' => 'Civil Engineering'],
//            ['name_km' => 'គណនី', 'name_en' => 'Biotechnology'],
//            ['name_km' => 'គណនី', 'name_en' => 'Botany'],
//            ['name_km' => 'គណនី', 'name_en' => 'Broadcast Journalism'],
//            ['name_km' => 'គណនី', 'name_en' => 'Broadcast Engineering'],
            ['name_km' => 'គ្រប់គ្រងធុរកិច្ច', 'name_en' => 'Business Administration'],
//            ['name_km' => 'គណនី', 'name_en' => 'Business Administration Management'],
//            ['name_km' => 'គ្រប់គ្រងធុរកិច្ច', 'name_en' => 'Business Management'],
//            ['name_km' => 'គណនី', 'name_en' => 'Behavioral Science'],
//            ['name_km' => 'គណនី', 'name_en' => 'Business'],
//            ['name_km' => 'គណនី', 'name_en' => 'Cellular Biology'],
//            ['name_km' => 'គណនី', 'name_en' => 'Chemical Engineering'],
            ['name_km' => 'គីមីវិទ្យា', 'name_en' => 'Chemistry'],
            ['name_km' => 'វិស្វកម្មគីមី និងបច្ចេកវិទ្យាអាហារ', 'name_en' => 'Chemical Engineering and Food Technology'],
//            ['name_km' => 'គណនី', 'name_en' => 'Child Development'],
            ['name_km' => 'ភសាចិន', 'name_en' => 'Chinese'],
//            ['name_km' => 'គណនី', 'name_en' => 'Classics'],
//            ['name_km' => 'គណនី', 'name_en' => 'Commerce'],
//            ['name_km' => 'គណនី', 'name_en' => 'Communication Media'],
            ['name_km' => 'អភិវឌ្ឍន៍សហគមន៍', 'name_en' => 'Community Development'],
//            ['name_km' => 'គណនី', 'name_en' => 'Communication'],
//            ['name_km' => 'គណនី', 'name_en' => 'Comparative Literature'],
//            ['name_km' => 'គណនី', 'name_en' => 'Computer Engineering'],
//            ['name_km' => 'គណនី', 'name_en' => 'Computer Science'],
//            ['name_km' => 'គណនី', 'name_en' => 'Consulting'],
//            ['name_km' => 'គណនី', 'name_en' => 'Consumer Sciences'],
//            ['name_km' => 'គណនី', 'name_en' => 'Creative Arts'],
//            ['name_km' => 'គណនី', 'name_en' => 'Mechanical Engineering'],
//            ['name_km' => 'គណនី', 'name_en' => 'Criminal Justice'],
//            ['name_km' => 'គណនី', 'name_en' => 'Culinary Arts'],
//            ['name_km' => 'គណនី', 'name_en' => 'Cultural Studies'],
//            ['name_km' => 'គណនី', 'name_en' => 'Dairy Science'],
//            ['name_km' => 'គណនី', 'name_en' => 'Dance'],
//            ['name_km' => 'គណនី', 'name_en' => 'Earth Sciences'],
//            ['name_km' => 'គណនី', 'name_en' => 'Ecology'],
//            ['name_km' => 'គណនី', 'name_en' => 'Economic Studies'],
            ['name_km' => 'អភិវឌ្ឍសេដ្ឋកិច្ច', 'name_en' => 'Economic development'],
            ['name_km' => 'វិទ្យាសាស្ត្រសេដ្ឋកិច្ច', 'name_en' => 'Economics'],
            ['name_km' => 'សេដ្ឋកិច្ច និងគ្រប់គ្រង', 'name_en' => 'Economics and Management'],
//            ['name_km' => 'គណនី', 'name_en' => 'Education'],
//            ['name_km' => 'គណនី', 'name_en' => 'Electrical and Electronic Engineering'],
            ['name_km' => 'អគ្គិសនី និងអេឡិចត្រូនិច', 'name_en' => 'Electricity and Electronics'],
            ['name_km' => 'គណនី', 'name_en' => 'Engineering'],
            ['name_km' => 'គណនី', 'name_en' => 'Engineering'],
//            ['name_km' => 'គណនី', 'name_en' => 'English Teacher Education'],
            ['name_km' => 'ភាសាអង់គ្លេស', 'name_en' => 'English'],
//            ['name_km' => 'គណនី', 'name_en' => 'Entomology'],
//            ['name_km' => 'គណនី', 'name_en' => 'Environmental Engineering'],
//            ['name_km' => 'គណនី', 'name_en' => 'Environmental Health'],
//            ['name_km' => 'គណនី', 'name_en' => 'Environmental Studies'],
            ['name_km' => 'បរិស្ថាន', 'name_en' => 'Environmental'],
            ['name_km' => 'សហគ្រិនភាព', 'name_en' => 'Entrepreneurship'],
            ['name_km' => 'គ្រប់គ្រងព្រឹត្តិការណ៍', 'name_en' => 'Event Management'],
//            ['name_km' => 'គណនី', 'name_en' => 'Ethnic Studies'],
//            ['name_km' => 'គណនី', 'name_en' => 'Library Studies'],
//            ['name_km' => 'គណនី', 'name_en' => 'European Studies'],
//            ['name_km' => 'គណនី', 'name_en' => 'Family and Consumer Sciences'],
//            ['name_km' => 'គណនី', 'name_en' => 'Fashion Merchandising'],
//            ['name_km' => 'គណនី', 'name_en' => 'Film and Television Studies'],
//            ['name_km' => 'គណនី', 'name_en' => 'Retail Studies'],
//            ['name_km' => 'គណនី', 'name_en' => 'Finance Accounting'],
//            ['name_km' => 'ធនាគារ និងហិរញ្ញវត្ថុ', 'name_en' => 'Finance Banking'],
//            ['name_km' => 'គណនី', 'name_en' => 'Finance'],
            ['name_km' => 'វិចិត្រកម្ម', 'name_en' => 'Fine Arts'],
//            ['name_km' => 'គណនី', 'name_en' => 'Food Science'],
//            ['name_km' => 'គណនី', 'name_en' => 'Materials Science'],
//            ['name_km' => 'គណនី', 'name_en' => 'Forestry'],
            ['name_km' => 'វិទ្យសាស្ត្រជលផល', 'name_en' => 'Fisheries Science'],
            ['name_km' => 'វិទ្យសាស្ត្រព្រៃឈើ', 'name_en' => 'Forest Science'],
            ['name_km' => 'ភាសាបារាំង', 'name_en' => 'French'],
//            ['name_km' => 'គណនី', 'name_en' => 'Gender and Diversity'],
//            ['name_km' => 'គណនី', 'name_en' => 'Genetic'],
            ['name_km' => 'ភូមិវិទ្យា', 'name_en' => 'Geography'],
            ['name_km' => 'ភូមិវិទ្យា និងរៀបចំដែនដី', 'name_en' => 'Geography and Land Management'],
//            ['name_km' => 'គណនី', 'name_en' => 'Geology'],
//            ['name_km' => 'គណនី', 'name_en' => 'German'],
//            ['name_km' => 'គណនី', 'name_en' => 'Gerontology'],
//            ['name_km' => 'គណនី', 'name_en' => 'Graphic Arts'],
            ['name_km' => 'គំនូរសារគមនាគមន៍', 'name_en' => 'Graphic Design'],
//            ['name_km' => 'គណនី', 'name_en' => 'Greek'],
//            ['name_km' => 'គណនី', 'name_en' => 'Accounting'],
//            ['name_km' => 'គណនី', 'name_en' => 'Health Science'],
//            ['name_km' => 'គណនី', 'name_en' => 'Health Teacher Education'],
            ['name_km' => 'ប្រវត្តិវទ្យា', 'name_en' => 'History'],
            ['name_km' => 'សាកវប្បកម្ម', 'name_en' => 'Horticulture'],
//            ['name_km' => 'គណនី', 'name_en' => 'Hospitality'],
            ['name_km' => 'ធនធានមនុស្ស', 'name_en' => 'Human Resources'],
            ['name_km' => 'គ្រប់គ្រងធនធានមនុស្ស', 'name_en' => 'Human Resources Management'],
//            ['name_km' => 'គណនី', 'name_en' => 'Human Sciences'],
//            ['name_km' => 'គណនី', 'name_en' => 'Humanities'],
//            ['name_km' => 'គណនី', 'name_en' => 'Indian Studies'],
//            ['name_km' => 'គណនី', 'name_en' => 'Interior Design'],
            ['name_km' => 'វិស្វកម្មឧស្សាហកម្ម និងមេកានិច', 'name_en' => 'Industrial and Mechanical Engineering'],
            ['name_km' => 'សេដ្ឋកិច្ចព័ត៌មានវិទ្យា', 'name_en' => 'Informatics Economics'],
            ['name_km' => 'ព័ត៌មានវិទ្យា', 'name_en' => 'Information Technology'],
            ['name_km' => 'វិស្វកម្មបច្ចេកវិទ្យាព័ត៌មាន', 'name_en' => 'Information Technology Engineering'],
            ['name_km' => 'ភស្តុភារ', 'name_en' => 'Logistics'],
            ['name_km' => 'គ្រប់គ្រងភ័ស្តុភារ', 'name_en' => 'Logistics Management'],
            ['name_km' => 'គ្រប់គ្រងពាណិជ្ជកម្មអន្តរជាតិ', 'name_en' => 'International Business Management'],
            ['name_km' => 'សិក្សាអន្តរជាតិ', 'name_en' => 'International Studies'],
            ['name_km' => 'ទំនាក់ទំនងអន្តរជាតិ', 'name_en' => 'International Relations'],
            ['name_km' => 'បច្ចេកទេសកណ្ណធារសាស្ត្រ', 'name_en' => 'Irrigation Techniques'],
//            ['name_km' => 'គណនី', 'name_en' => 'Islamic Studies'],
//            ['name_km' => 'គណនី', 'name_en' => 'Italian'],
            ['name_km' => 'ភាសាជប៉ុន', 'name_en' => 'Japanese'],
//            ['name_km' => 'គណនី', 'name_en' => 'Jewish Studies'],
//            ['name_km' => 'គណនី', 'name_en' => 'Journalism'],
            ['name_km' => 'អក្សរសាស្ត្រខ្មែរ', 'name_en' => 'Khmer Literature'],
            ['name_km' => 'ភាសាកូរ៉េ', 'name_en' => 'Korean'],
//            ['name_km' => 'គណនី', 'name_en' => 'Landscape Architecture'],
            ['name_km' => 'ដីធ្លី រៀបចំដែនដី និងរដ្ឋបានដីធ្លី', 'name_en' => 'Land Management and Land Administration'],
//            ['name_km' => 'គណនី', 'name_en' => 'Languages'],
//            ['name_km' => 'គណនី', 'name_en' => 'Latin'],
            ['name_km' => 'នីតិសាស្ត្រ', 'name_en' => 'Law'],
//            ['name_km' => 'គណនី', 'name_en' => 'Leadership Studies'],
//            ['name_km' => 'គណនី', 'name_en' => 'Liberal Arts Sciences'],
//            ['name_km' => 'គណនី', 'name_en' => 'Linguistics'],
//            ['name_km' => 'គណនី', 'name_en' => 'Literature'],
            ['name_km' => 'ចម្លាក់ទំនើប', 'name_en' => 'Modern Sculpture'],
//            ['name_km' => 'គណនី', 'name_en' => 'Malaysian Studies'],
//            ['name_km' => 'គណនី', 'name_en' => 'Management Information Systems'],
            ['name_km' => 'គ្រប់គ្រង', 'name_en' => 'Management'],
//            ['name_km' => 'គណនី', 'name_en' => 'Marketing Education'],
            ['name_km' => 'ទន្តសាស្ត្រ', 'name_en' => 'Dentistry'],
            ['name_km' => 'ទីផ្សារ', 'name_en' => 'Marketing'],
//            ['name_km' => 'គណនី', 'name_en' => 'Mathematics Education'],
            ['name_km' => 'គណិតវិទ្យា', 'name_en' => 'Mathematics'],
//            ['name_km' => 'គណនី', 'name_en' => 'MBA'],
//            ['name_km' => 'គណនី', 'name_en' => 'Mechatronics'],
            ['name_km' => 'វេជ្ជសាស្ត្រ', 'name_en' => 'Medical'],
            ['name_km' => 'ជំនួយវេជ្ជសាស្រ្ដ', 'name_en' => 'Medical Assistance'],
//            ['name_km' => 'គណនី', 'name_en' => 'Medical Dietetics'],
//            ['name_km' => 'គណនី', 'name_en' => 'Medical Sciences'],
//            ['name_km' => 'គណនី', 'name_en' => 'Medieval Studies'],
            ['name_km' => 'វិស្វកម្មធនធានរ៉ែ និងភូគព្ភសាស្ត្រ', 'name_en' => 'Mineral Resources and Geological Engineering'],
//            ['name_km' => 'គណនី', 'name_en' => 'Microbiology'],
            ['name_km' => 'គ្រប់គ្រងមីក្រូហិរញ្ញវត្ថុ', 'name_en' => 'Microfinance Management'],
//            ['name_km' => 'គណនី', 'name_en' => 'Military Studies'],
//            ['name_km' => 'គណនី', 'name_en' => 'Museum Studies'],
//            ['name_km' => 'គណនី', 'name_en' => 'Music Performance'],
//            ['name_km' => 'គណនី', 'name_en' => 'Music Teacher Education'],
//            ['name_km' => 'គណនី', 'name_en' => 'Music Theory'],
//            ['name_km' => 'គណនី', 'name_en' => 'Music Therapy'],
            ['name_km' => 'តូរ្យតន្ត្រី', 'name_en' => 'Music'],
//            ['name_km' => 'គណនី', 'name_en' => 'Nautical Studies'],
//            ['name_km' => 'គណនី', 'name_en' => 'Near Eastern Studies'],
            ['name_km' => 'គ្រប់គ្រង និងអភិវឌ្ឍន៍ធនធានធម្មជាតិ', 'name_en' => 'Natural Resource Management and Development'],
//            ['name_km' => 'គណនី', 'name_en' => 'Nursing'],
//            ['name_km' => 'គណនី', 'name_en' => 'Oceanography'],
            ['name_km' => 'សិល្បៈនាដសាស្ត្រ', 'name_en' => 'Performing Arts'],
//            ['name_km' => 'គណនី', 'name_en' => 'Paramedical Studies'],
//            ['name_km' => 'គណនី', 'name_en' => 'Peace Studies'],
//            ['name_km' => 'គណនី', 'name_en' => 'Pharmacy'],
            ['name_km' => 'ឱសថសាស្ត្រ', 'name_en' => 'Pharmacology'],
//            ['name_km' => 'គណនី', 'name_en' => 'Philosophy'],
//            ['name_km' => 'គណនី', 'name_en' => 'Physical Education'],
//            ['name_km' => 'គណនី', 'name_en' => 'Physical Sciences'],
//            ['name_km' => 'គណនី', 'name_en' => 'Physical Therapy'],
            ['name_km' => 'រូបវិទ្យា', 'name_en' => 'Physics'],
//            ['name_km' => 'គណនី', 'name_en' => 'Policy Management'],
            ['name_km' => 'វិទ្យាសាស្ត្រ​នយោបាយ', 'name_en' => 'Political Science'],
//            ['name_km' => 'គណនី', 'name_en' => 'Poultry Science'],
//            ['name_km' => 'គណនី', 'name_en' => 'Preschool Education'],
//            ['name_km' => 'គណនី', 'name_en' => 'Primary Education'],
            ['name_km' => 'ចិត្តវិទ្យា', 'name_en' => 'Psychology'],
//            ['name_km' => 'គណនី', 'name_en' => 'Public Health Education'],
//            ['name_km' => 'គណនី', 'name_en' => 'Public Relations'],
            ['name_km' => 'រដ្ឋបាល​សាធារណៈ', 'name_en' => 'Public Administration'],
//            ['name_km' => 'គណនី', 'name_en' => 'Real Estate'],
//            ['name_km' => 'គណនី', 'name_en' => 'Religious Studies'],
//            ['name_km' => 'គណនី', 'name_en' => 'Rhetorical Studies'],
            ['name_km' => 'គ្រប់គ្រងហានិភ័យ', 'name_en' => 'Risk Management'],
//            ['name_km' => 'គណនី', 'name_en' => 'Romance Languages'],
//            ['name_km' => 'គណនី', 'name_en' => 'Russian Studies'],
            ['name_km' => 'វិទ្យាសាស្ត្រកៅស៊ូ', 'name_en' => 'Rubber Science'],
//            ['name_km' => 'គណនី', 'name_en' => 'Science Teacher Education'],
//            ['name_km' => 'គណនី', 'name_en' => 'Science'],
//            ['name_km' => 'គណនី', 'name_en' => 'Social Sciences'],
           ['name_km' => 'សង្គមកិច្ចវិទ្យា', 'name_en' => 'Social Studies'],
//            ['name_km' => 'គណនី', 'name_en' => 'Mining Engineering'],
            ['name_km' => 'សង្គមវិទ្យា', 'name_en' => 'Sociology'],
//            ['name_km' => 'គណនី', 'name_en' => 'Spanish'],
//            ['name_km' => 'គណនី', 'name_en' => 'Special Education'],
//            ['name_km' => 'គណនី', 'name_en' => 'Sports'],
//            ['name_km' => 'គណនី', 'name_en' => 'Statistics'],
//            ['name_km' => 'គណនី', 'name_en' => 'Strategic Management'],
//            ['name_km' => 'គណនី', 'name_en' => 'Studio Arts'],
//            ['name_km' => 'គណនី', 'name_en' => 'Teacher Education'],
            ['name_km' => 'វិស្វកម្មទូរគមនាគមន៍ និងអេឡិចត្រូនិច', 'name_en' => 'Telecommunication and Electronic Engineering'],
            ['name_km' => 'ភាសាថៃ', 'name_en' => 'Thai'],
//            ['name_km' => 'គណនី', 'name_en' => 'Theater Arts'],
//            ['name_km' => 'គណនី', 'name_en' => 'Theology'],
            ['name_km' => 'ទេសចរណ៍', 'name_en' => 'Tourism'],
//            ['name_km' => 'គណនី', 'name_en' => 'Training'],
//            ['name_km' => 'គណនី', 'name_en' => 'Turf Management'],
            ['name_km' => 'វេជ្ជសាស្ត្រសត្វ', 'name_en' => 'Veterinary Medicine'],
            ['name_km' => 'វិស្វកម្មធនធានទឹក និងហេដ្ឋារចនាសម្ពន្ធជនបទ', 'name_en' => 'Water Resources Engineering and Rural Infrastructure'],
//            ['name_km' => 'គណនី', 'name_en' => 'Wilderness Management'],
//            ['name_km' => 'គណនី', 'name_en' => "Women's Studies"],
//            ['name_km' => 'គណនី', 'name_en' => 'Writing'],
//            ['name_km' => 'គណនី', 'name_en' => 'Zoology'],
        ]);
    }
}
