<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

// ===============================
// 🌍 Публичная часть (с локализацией)
// ===============================
Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localeViewPath']
], function () {
    Route::get('/', [App\Http\Controllers\Web\HomeController::class, 'anniversary'])->name('web.home');
    Route::get('/welcome', [App\Http\Controllers\Web\HomeController::class, 'index'])->name('web.welcome');
    Route::get('/products', [App\Http\Controllers\Web\HomeController::class, 'categoryProducts'])->name('category.products');
    Route::get('/news', [App\Http\Controllers\Web\HomeController::class, 'allNews'])->name('web.allnews');
    Route::get('/about_us', [App\Http\Controllers\Web\HomeController::class, 'aboutUs'])->name('about_us');
    Route::get('/turkmen-gips', [App\Http\Controllers\Web\HomeController::class, 'turkmenGips'])->name('turkmen.gips');
    Route::get('/news/{news}', [App\Http\Controllers\Web\HomeController::class, 'showNews'])->name('web.news');
    Route::get('/privacy', [App\Http\Controllers\Web\HomeController::class, 'Privacy'])->name('web.privacy');
    
    // All horses page
    Route::get('/horses', function () {
        $horses = [
            ['id' => 1, 'name' => 'Garagum', 'breed' => 'Ahalteke Bedewi', 'image' => '1.jpg'],
            ['id' => 2, 'name' => 'Aýgytly', 'breed' => 'Ahalteke Bedewi', 'image' => '2.jpg'],
            ['id' => 3, 'name' => 'Şöhrat', 'breed' => 'Ahalteke Bedewi', 'image' => '3.jpg'],
            ['id' => 4, 'name' => 'Meýdan', 'breed' => 'Ahalteke Bedewi', 'image' => '4.jpg'],
            ['id' => 5, 'name' => 'Paýhas', 'breed' => 'Ahalteke Bedewi', 'image' => '5.jpg'],
            ['id' => 6, 'name' => 'Görogly', 'breed' => 'Ahalteke Bedewi', 'image' => '6.jpg'],
            ['id' => 7, 'name' => 'Günbatar', 'breed' => 'Ahalteke Bedewi', 'image' => '7.jpg'],
            ['id' => 8, 'name' => 'Daýhan', 'breed' => 'Ahalteke Bedewi', 'image' => '8.jpg'],
            ['id' => 9, 'name' => 'Altyn Asyr', 'breed' => 'Ahalteke Bedewi', 'image' => '9.jpg'],
            ['id' => 10, 'name' => 'Hazar', 'breed' => 'Ahalteke Bedewi', 'image' => '10.jpg'],
            ['id' => 11, 'name' => 'Watan', 'breed' => 'Ahalteke Bedewi', 'image' => '11.jpg'],
            ['id' => 12, 'name' => 'Bitaraplyk', 'breed' => 'Ahalteke Bedewi', 'image' => '12.jpg'],
            ['id' => 13, 'name' => 'Garaşsyzlyk', 'breed' => 'Ahalteke Bedewi', 'image' => '13.jpg'],
            ['id' => 14, 'name' => 'Ahal', 'breed' => 'Ahalteke Bedewi', 'image' => '14.jpg'],
            ['id' => 15, 'name' => 'Arkadag', 'breed' => 'Ahalteke Bedewi', 'image' => '15.jpg'],
            ['id' => 16, 'name' => 'Türkmenistan', 'breed' => 'Ahalteke Bedewi', 'image' => '16.jpg'],
        ];
        return view('all-horses', compact('horses'));
    })->name('horses.all');
    
    // Horse profile page
    Route::get('/horse/{id}', function ($id) {
        $baseHorses = [
            ['id' => 1, 'name' => 'Garagum', 'breed' => 'Ahalteke Bedewi', 'height' => 165, 'age' => 5, 'color' => 'Altyn', 'gender' => 'Erkek'],
            ['id' => 2, 'name' => 'Aýgytly', 'breed' => 'Ahalteke Bedewi', 'height' => 162, 'age' => 4, 'color' => 'Gara', 'gender' => 'Erkek'],
            ['id' => 3, 'name' => 'Şöhrat', 'breed' => 'Ahalteke Bedewi', 'height' => 168, 'age' => 6, 'color' => 'Ak', 'gender' => 'Erkek'],
            ['id' => 4, 'name' => 'Meýdan', 'breed' => 'Ahalteke Bedewi', 'height' => 170, 'age' => 7, 'color' => 'Gyzyl', 'gender' => 'Erkek'],
            ['id' => 5, 'name' => 'Paýhas', 'breed' => 'Ahalteke Bedewi', 'height' => 163, 'age' => 5, 'color' => 'Çal', 'gender' => 'Erkek'],
            ['id' => 6, 'name' => 'Görogly', 'breed' => 'Ahalteke Bedewi', 'height' => 167, 'age' => 8, 'color' => 'Altyn', 'gender' => 'Erkek'],
            ['id' => 7, 'name' => 'Günbatar', 'breed' => 'Ahalteke Bedewi', 'height' => 164, 'age' => 4, 'color' => 'Goňur', 'gender' => 'Erkek'],
            ['id' => 8, 'name' => 'Daýhan', 'breed' => 'Ahalteke Bedewi', 'height' => 166, 'age' => 6, 'color' => 'Gara', 'gender' => 'Erkek'],
            ['id' => 9, 'name' => 'Altyn Asyr', 'breed' => 'Ahalteke Bedewi', 'height' => 169, 'age' => 5, 'color' => 'Altyn', 'gender' => 'Erkek'],
            ['id' => 10, 'name' => 'Hazar', 'breed' => 'Ahalteke Bedewi', 'height' => 165, 'age' => 7, 'color' => 'Çal', 'gender' => 'Erkek'],
            ['id' => 11, 'name' => 'Watan', 'breed' => 'Ahalteke Bedewi', 'height' => 166, 'age' => 4, 'color' => 'Ak', 'gender' => 'Erkek'],
            ['id' => 12, 'name' => 'Bitaraplyk', 'breed' => 'Ahalteke Bedewi', 'height' => 164, 'age' => 6, 'color' => 'Goňur', 'gender' => 'Erkek'],
            ['id' => 13, 'name' => 'Garaşsyzlyk', 'breed' => 'Ahalteke Bedewi', 'height' => 168, 'age' => 5, 'color' => 'Gyzyl', 'gender' => 'Erkek'],
            ['id' => 14, 'name' => 'Ahal', 'breed' => 'Ahalteke Bedewi', 'height' => 167, 'age' => 8, 'color' => 'Gara', 'gender' => 'Erkek'],
            ['id' => 15, 'name' => 'Arkadag', 'breed' => 'Ahalteke Bedewi', 'height' => 170, 'age' => 7, 'color' => 'Altyn', 'gender' => 'Erkek'],
            ['id' => 16, 'name' => 'Türkmenistan', 'breed' => 'Ahalteke Bedewi', 'height' => 169, 'age' => 6, 'color' => 'Çal', 'gender' => 'Erkek'],
        ];

        $stories = [
            1 => 'Garagum - Garagum çölleriniň gyzgyn şemaly bilen ýetişen bedew. Irden türgenleşik wagty onuň ýörişi saz ýaly sazlaşýar, agşam bolsa ol asuda häsiýeti bilen serkerde ýaly ümsümleşýär. Bir gezek güýçli gum tupany wagtynda öýüne ýol tapyp, öz bakyjysyny howpsuz ýere alyp çykandygy üçin bu at hakda oba arasynda rowaýatlar aýdylýar.',
            2 => 'Aýgytly - ýaş bolsa-da karar berişi tiz we göwresi güýçli at. Ýaryş meýdanynda ol ilkinji aýlawda sabyrly bolup, soňky bölekde çaltlygyny doly açýar. Bakyjysy onuň her gezek start öňüsyrasy gözüne seredende, atyň öz maksadyny öňünden bilýän ýaly duýulýandygyny aýdýar.',
            3 => 'Şöhrat - ak reňkli, gyl ýaly tertipli häsiýetli bedew. Dabaraly çykyşlarda ol diňe tizligi bilen däl, eýsem duruşy we hereketiniň gözelligi bilen hem adamları haýran galdyrýar. Onuň iň uly aýratynlygy, köp adamly ýerde-de ynjalygyny ýitirmezligi we eýesine hemişe gullukda bolmagydyr.',
            4 => 'Meýdan - uzak aralyga ýaradylyp, çydamlylyk boýunça tanalan bedew. Gaty howada-da, sowuk şemalde-de şol bir depginde hereket edip bilýär. Oba ýaryşlarynda ol diňe ýeňiş gazanmak üçin däl, ýaş türgenlere sapak bolmak üçin hem çykarylýar.',
            5 => 'Paýhas - ady ýaly paýhasly we adam bilen çalt öwrenişýän at. Täze türgenleriň ilkinji sapaklarynda ol sabyr bilen ädimlerini sazlaýar we howsala düşen pursatlarynda-da asudalygyny saklaýar. Şol sebäpli bu bedew diňe ýaryş atlary arasynda däl, okuw atlary arasynda-da aýratyn hormata eýe.',
            6 => 'Görogly - güýç, gaýrat we erk-islegi bilen tanalýan köne çempion. Uzak ýyllaryň türgenleşiginden soň hem onuň göwresi berk, hereketi inçe galypdyr. Onuň bilen baýramçylyk çykyşlarynda çykyş etmek köp türgeniň arzuwy hasaplanýar, sebäbi Görogly her gezek meýdana çyksa baýramçylyga aýratyn ruh berýär.',
            7 => 'Günbatar - gün ýaşanda öwüsýän mylaýym şemal ýaly asuda bedew. Ol giň meýdanda erkin ylgamagy halaýar we uzyn ýörişlerde ähli topary öz depgine görä deňläp bilýär. Bakyjylar bu aty toparyň ritmini saklaýan görünmeýän sazanda diýip atlandyrýarlar.',
            8 => 'Daýhan - işeňňirligi we ygtybarlylygy bilen tanalýan hyzmatkär bedew. Oba şertlerinde dürli işleri ýerine ýetirip, her bir ynanyşygy aklaýar. Daýhan hakda iň köp aýdylýan söz: ol ýadawlygy görkezmeýär, sebäbi her hereketini maksatly edýär.',
            9 => 'Altyn Asyr - şöhleli reňki sebäpli uzakdan tanalýan görnaýyn bedew. Resmi dabaralarda onuň ýöräp geçişi tomaşaçylaryň ünsüni derrew özüne çekýär. Ol diňe owadan görnüş däl, eýsem türgenleşikde hem tertibi ýokary bolup, wagtynda taýýarlyk görýän at hökmünde bellenýär.',
            10 => 'Hazar - çuňluk we durnuklylyk häsiýetini özünde jemlän bedew. Deňiz kenaryndaky ýele öwrenişen ýaly, dürli şertlerde öz depginini ýitirmeýär. Uzak ýol saparlarynda Hazar toparyň iň ygtybarly öňbaşçylarynyň biri hasaplanylýar.',
            11 => 'Watan - asyllylygy we wepalylygy bilen hormat gazanan ak bedew. Köpçülikleýin dabaralarda ol durky bilen parahatlyk we ynam duýgusyny berýär. Eýesi aýdýar: Watan öňe seredýän at, ol her ädimde öz ynamyny ähli topara geçirýär.',
            12 => 'Bitaraplyk - ümsüm, deňagramly we berk psihologiýaly bedew. Sesli ýerlerde hem aljyramaýanlygy sebäpli sergi çykyşlarynda ony ýygy-ýygydan saýlaýarlar. Bu atyň iň uly güýji onuň asuda häsiýetidir: ol howlukmaýar, ýöne hemişe maksadyna ýetýär.',
            13 => 'Garaşsyzlyk - güýçli depgin we erkin ruh bilen tanalýan bedew. Start berlen dessine öňe çykmaga çalyşsa-da, türgeniniň buýrugyna görä özüni tertipde saklaýar. Onuň ylgawynda güýç bilen intellektiň sazlaşygy duýulýar.',
            14 => 'Ahal - Ahalteke nesliniň gadymy merkezi bilen baglanyşýan at. Uzyn boýy we berk beden gurluşy sebäpli ol agyr türgenleşiklerden soň hem tiz diklenýär. Tejribeli tälimçiler Ahaly ýaş atlara görelde hökmünde görkezýärler.',
            15 => 'Arkadag - topary öňe alyp barmagy başarýan lider häsiýetli bedew. Ýaryşdan öň ol mydama asuda durýar, meýdana çykanda bolsa güýçli energiýa bilen ählini ruhlandyrýar. Bu atyň taryhynda birnäçe ýeňiş bar, emma onuň iň uly aýratynlygy - tälimçiniň her alamatyna takyk jogap bermegi.',
            16 => 'Türkmenistan - bu kolleksiýanyň jemleýji buýsanjy. Onuň hereketinde hem milli bedewçiligiň klassik keşbi, hem döwrebap taýýarlygyň netijesi görünýär. Bu at bilen geçirilýän her çykyş tomaşaçylara diňe bir gözellik däl, eýsem türkmen atçylyk däpleriniň dowamlylygyny hem görkezýär.',
        ];

        $horses = array_map(function ($horse) use ($stories) {
            $id = $horse['id'];
            $horse['image'] = $id . '.jpg';
            $horse['images'] = [
                $id . '.jpg',
                (($id % 16) + 1) . '.jpg',
                ((($id + 1) % 16) + 1) . '.jpg',
                ((($id + 2) % 16) + 1) . '.jpg',
            ];
            $horse['video'] = 'akbulut.mp4';
            $horse['description'] = $stories[$id] ?? '';
            return $horse;
        }, $baseHorses);

        $horse = collect($horses)->firstWhere('id', (int) $id);

        if (!$horse) {
            abort(404);
        }

        return view('horse-qr', compact('horse'));
    })->name('horse.profile');

    // Horse desktop profile page
    Route::get('/horse-desktop/{id}', function ($id) {
        $baseHorses = [
            ['id' => 1, 'name' => 'Garagum', 'breed' => 'Ahalteke Bedewi', 'height' => 165, 'age' => 5, 'color' => 'Altyn', 'gender' => 'Erkek'],
            ['id' => 2, 'name' => 'Aýgytly', 'breed' => 'Ahalteke Bedewi', 'height' => 162, 'age' => 4, 'color' => 'Gara', 'gender' => 'Erkek'],
            ['id' => 3, 'name' => 'Şöhrat', 'breed' => 'Ahalteke Bedewi', 'height' => 168, 'age' => 6, 'color' => 'Ak', 'gender' => 'Erkek'],
            ['id' => 4, 'name' => 'Meýdan', 'breed' => 'Ahalteke Bedewi', 'height' => 170, 'age' => 7, 'color' => 'Gyzyl', 'gender' => 'Erkek'],
            ['id' => 5, 'name' => 'Paýhas', 'breed' => 'Ahalteke Bedewi', 'height' => 163, 'age' => 5, 'color' => 'Çal', 'gender' => 'Erkek'],
            ['id' => 6, 'name' => 'Görogly', 'breed' => 'Ahalteke Bedewi', 'height' => 167, 'age' => 8, 'color' => 'Altyn', 'gender' => 'Erkek'],
            ['id' => 7, 'name' => 'Günbatar', 'breed' => 'Ahalteke Bedewi', 'height' => 164, 'age' => 4, 'color' => 'Goňur', 'gender' => 'Erkek'],
            ['id' => 8, 'name' => 'Daýhan', 'breed' => 'Ahalteke Bedewi', 'height' => 166, 'age' => 6, 'color' => 'Gara', 'gender' => 'Erkek'],
            ['id' => 9, 'name' => 'Altyn Asyr', 'breed' => 'Ahalteke Bedewi', 'height' => 169, 'age' => 5, 'color' => 'Altyn', 'gender' => 'Erkek'],
            ['id' => 10, 'name' => 'Hazar', 'breed' => 'Ahalteke Bedewi', 'height' => 165, 'age' => 7, 'color' => 'Çal', 'gender' => 'Erkek'],
            ['id' => 11, 'name' => 'Watan', 'breed' => 'Ahalteke Bedewi', 'height' => 166, 'age' => 4, 'color' => 'Ak', 'gender' => 'Erkek'],
            ['id' => 12, 'name' => 'Bitaraplyk', 'breed' => 'Ahalteke Bedewi', 'height' => 164, 'age' => 6, 'color' => 'Goňur', 'gender' => 'Erkek'],
            ['id' => 13, 'name' => 'Garaşsyzlyk', 'breed' => 'Ahalteke Bedewi', 'height' => 168, 'age' => 5, 'color' => 'Gyzyl', 'gender' => 'Erkek'],
            ['id' => 14, 'name' => 'Ahal', 'breed' => 'Ahalteke Bedewi', 'height' => 167, 'age' => 8, 'color' => 'Gara', 'gender' => 'Erkek'],
            ['id' => 15, 'name' => 'Arkadag', 'breed' => 'Ahalteke Bedewi', 'height' => 170, 'age' => 7, 'color' => 'Altyn', 'gender' => 'Erkek'],
            ['id' => 16, 'name' => 'Türkmenistan', 'breed' => 'Ahalteke Bedewi', 'height' => 169, 'age' => 6, 'color' => 'Çal', 'gender' => 'Erkek'],
        ];

        $stories = [
            1 => 'Garagum - Garagum çölleriniň gyzgyn şemaly bilen ýetişen bedew. Irden türgenleşik wagty onuň ýörişi saz ýaly sazlaşýar, agşam bolsa ol asuda häsiýeti bilen serkerde ýaly ümsümleşýär. Bir gezek güýçli gum tupany wagtynda öýüne ýol tapyp, öz bakyjysyny howpsuz ýere alyp çykandygy üçin bu at hakda oba arasynda rowaýatlar aýdylýar.',
            2 => 'Aýgytly - ýaş bolsa-da karar berişi tiz we göwresi güýçli at. Ýaryş meýdanynda ol ilkinji aýlawda sabyrly bolup, soňky bölekde çaltlygyny doly açýar. Bakyjysy onuň her gezek start öňüsyrasy gözüne seredende, atyň öz maksadyny öňünden bilýän ýaly duýulýandygyny aýdýar.',
            3 => 'Şöhrat - ak reňkli, gyl ýaly tertipli häsiýetli bedew. Dabaraly çykyşlarda ol diňe tizligi bilen däl, eýsem duruşy we hereketiniň gözelligi bilen hem adamlary haýran galdyrýar. Onuň iň uly aýratynlygy, köp adamly ýerde-de ynjalygyny ýitirmezligi we eýesine hemişe gullukda bolmagydyr.',
            4 => 'Meýdan - uzak aralyga ýaradylyp, çydamlylyk boýunça tanalan bedew. Gaty howada-da, sowuk şemalde-de şol bir depginde hereket edip bilýär. Oba ýaryşlarynda ol diňe ýeňiş gazanmak üçin däl, ýaş türgenlere sapak bolmak üçin hem çykarylýar.',
            5 => 'Paýhas - ady ýaly paýhasly we adam bilen çalt öwrenişýän at. Täze türgenleriň ilkinji sapaklarynda ol sabyr bilen ädimlerini sazlaýar we howsala düşen pursatlarynda-da asudalygyny saklaýar. Şol sebäpli bu bedew diňe ýaryş atlary arasynda däl, okuw atlary arasynda-da aýratyn hormata eýe.',
            6 => 'Görogly - güýç, gaýrat we erk-islegi bilen tanalýan köne çempion. Uzak ýyllaryň türgenleşiginden soň hem onuň göwresi berk, hereketi inçe galypdyr. Onuň bilen baýramçylyk çykyşlarynda çykyş etmek köp türgeniň arzuwy hasaplanýar, sebäbi Görogly her gezek meýdana çyksa baýramçylyga aýratyn ruh berýär.',
            7 => 'Günbatar - gün ýaşanda öwüsýän mylaýym şemal ýaly asuda bedew. Ol giň meýdanda erkin ylgamagy halaýar we uzyn ýörişlerde ähli topary öz depgine görä deňläp bilýär. Bakyjylar bu aty toparyň ritmini saklaýan görünmeýän sazanda diýip atlandyrýarlar.',
            8 => 'Daýhan - işeňňirligi we ygtybarlylygy bilen tanalýan hyzmatkär bedew. Oba şertlerinde dürli işleri ýerine ýetirip, her bir ynanyşygy aklaýar. Daýhan hakda iň köp aýdylýan söz: ol ýadawlygy görkezmeýär, sebäbi her hereketini maksatly edýär.',
            9 => 'Altyn Asyr - şöhleli reňki sebäpli uzakdan tanalýan görnaýyn bedew. Resmi dabaralarda onuň ýöräp geçişi tomaşaçylaryň ünsüni derrew özüne çekýär. Ol diňe owadan görnüş däl, eýsem türgenleşikde hem tertibi ýokary bolup, wagtynda taýýarlyk görýän at hökmünde bellenýär.',
            10 => 'Hazar - çuňluk we durnuklylyk häsiýetini özünde jemlän bedew. Deňiz kenaryndaky ýele öwrenişen ýaly, dürli şertlerde öz depginini ýitirmeýär. Uzak ýol saparlarynda Hazar toparyň iň ygtybarly öňbaşçylarynyň biri hasaplanylýar.',
            11 => 'Watan - asyllylygy we wepalylygy bilen hormat gazanan ak bedew. Köpçülikleýin dabaralarda ol durky bilen parahatlyk we ynam duýgusyny berýär. Eýesi aýdýar: Watan öňe seredýän at, ol her ädimde öz ynamyny ähli topara geçirýär.',
            12 => 'Bitaraplyk - ümsüm, deňagramly we berk psihologiýaly bedew. Sesli ýerlerde hem aljyramaýanlygy sebäpli sergi çykyşlarynda ony ýygy-ýygydan saýlaýarlar. Bu atyň iň uly güýji onuň asuda häsiýetidir: ol howlukmaýar, ýöne hemişe maksadyna ýetýär.',
            13 => 'Garaşsyzlyk - güýçli depgin we erkin ruh bilen tanalýan bedew. Start berlen dessine öňe çykmaga çalyşsa-da, türgeniniň buýrugyna görä özüni tertipde saklaýar. Onuň ylgawynda güýç bilen intellektiň sazlaşygy duýulýar.',
            14 => 'Ahal - Ahalteke nesliniň gadymy merkezi bilen baglanyşýan at. Uzyn boýy we berk beden gurluşy sebäpli ol agyr türgenleşiklerden soň hem tiz diklenýär. Tejribeli tälimçiler Ahaly ýaş atlara görelde hökmünde görkezýärler.',
            15 => 'Arkadag - topary öňe alyp barmagy başarýan lider häsiýetli bedew. Ýaryşdan öň ol mydama asuda durýar, meýdana çykanda bolsa güýçli energiýa bilen ählini ruhlandyrýar. Bu atyň taryhynda birnäçe ýeňiş bar, emma onuň iň uly aýratynlygy - tälimçiniň her alamatyna takyk jogap bermegi.',
            16 => 'Türkmenistan - bu kolleksiýanyň jemleýji buýsanjy. Onuň hereketinde hem milli bedewçiligiň klassik keşbi, hem döwrebap taýýarlygyň netijesi görünýär. Bu at bilen geçirilýän her çykyş tomaşaçylara diňe bir gözellik däl, eýsem türkmen atçylyk däpleriniň dowamlylygyny hem görkezýär.',
        ];

        $horses = array_map(function ($horse) use ($stories) {
            $id = $horse['id'];
            $horse['image'] = $id . '.jpg';
            $horse['images'] = [
                $id . '.jpg',
                (($id % 16) + 1) . '.jpg',
                ((($id + 1) % 16) + 1) . '.jpg',
                ((($id + 2) % 16) + 1) . '.jpg',
            ];
            $horse['video'] = 'akbulut.mp4';
            $horse['description'] = $stories[$id] ?? '';
            return $horse;
        }, $baseHorses);

        $horse = collect($horses)->firstWhere('id', (int) $id);

        if (!$horse) {
            abort(404);
        }

        return view('horse-desktop', compact('horse'));
    })->name('horse.desktop');
});


// ===============================
// 🔐 Админка (без локализации)
// ===============================
Route::prefix('admin')->group(function () {
    
    // Авторизация
    Auth::routes(['register' => true]);

    // Доступ только после входа
    Route::middleware(['auth'])->group(function () {

        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

        // CRUD ресурсы
        Route::resources([
            'categories' => App\Http\Controllers\CategoryController::class,
            'sliders'    => App\Http\Controllers\SliderController::class,
            'privacies'  => App\Http\Controllers\PrivacyController::class,
            'products'   => App\Http\Controllers\ProductController::class,
            'abouts'     => App\Http\Controllers\AboutController::class,
            'news'       => App\Http\Controllers\NewsController::class,
            'galleries'  => App\Http\Controllers\GalleryController::class,
        ]);

        // Менеджер файлов
        Route::get('filemanager', [App\Http\Controllers\FileManagerController::class, 'index'])->name('files.index');

        // Контакты (обратная связь)
        Route::get('contacts', [App\Http\Controllers\ContactController::class, 'index'])->name('feedbacks.index');
        Route::delete('contacts/{id}', [App\Http\Controllers\ContactController::class, 'destroy'])->name('feedbacks.destroy');

        // Загрузка файлов из CKEditor / продуктов
        Route::post('news/upload', [App\Http\Controllers\NewsController::class, 'upload'])->name('ckeditor.upload');
        Route::post('products/upload', [App\Http\Controllers\ProductController::class, 'upload'])->name('products.upload');
    });
});

