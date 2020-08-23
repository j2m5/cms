@switch($user->class)
    @case('Sith Juggernaut')
        <option value="Immortal" @if($user->spec === 'Immortal') selected @endif>Immortal</option>
        <option value="Vengeance" @if($user->spec === 'Vengeance') selected @endif>Vengeance</option>
        <option value="Rage" @if($user->spec === 'Rage') selected @endif>Rage</option>
    @break
    @case('Sith Marauder')
        <option value="Annihilation" @if($user->spec === 'Annihilation') selected @endif>Annihilation</option>
        <option value="Carnage" @if($user->spec === 'Carnage') selected @endif>Carnage</option>
        <option value="Fury" @if($user->spec === 'Fury') selected @endif>Fury</option>
    @break
    @case('Sith Sorcerer')
        <option value="Corruption" @if($user->spec === 'Corruption') selected @endif>Corruption</option>
        <option value="Lightning" @if($user->spec === 'Lightning') selected @endif>Lightning</option>
        <option value="Madness" @if($user->spec === 'Madness') selected @endif>Madness</option>
    @break
    @case('Sith Assassin')
        <option value="Darkness" @if($user->spec === 'Darkness') selected @endif>Darkness</option>
        <option value="Deception" @if($user->spec === 'Deception') selected @endif>Deception</option>
        <option value="Hatred" @if($user->spec === 'Hatred') selected @endif>Hatred</option>
    @break
    @case('Sniper')
        <option value="Marksmanship" @if($user->spec === 'Marksmanship') selected @endif>Marksmanship</option>
        <option value="Engineering" @if($user->spec === 'Engineering') selected @endif>Engineering</option>
        <option value="Virulence" @if($user->spec === 'Virulence') selected @endif>Virulence</option>
    @break
    @case('Operative')
        <option value="Medicine" @if($user->spec === 'Medicine') selected @endif>Medicine</option>
        <option value="Concealment" @if($user->spec === 'Concealment') selected @endif>Concealment</option>
        <option value="Lethality" @if($user->spec === 'Lethality') selected @endif>Lethality</option>
    @break
    @case('Mercenary')
        <option value="Bodyguard" @if($user->spec === 'Bodyguard') selected @endif>Bodyguard</option>
        <option value="Arsenal" @if($user->spec === 'Arsenal') selected @endif>Arsenal</option>
        <option value="Innovative Ordnance" @if($user->spec === 'Innovative Ordnance') selected @endif>Innovative Ordnance</option>
    @break
    @case('Powertech')
        <option value="Shield tech" @if($user->spec === 'Shield tech') selected @endif>Shield tech</option>
        <option value="Advanced Prototype" @if($user->spec === 'Advanced Prototype') selected @endif>Advanced Prototype</option>
        <option value="Pyrotech" @if($user->spec === 'Pyrotech') selected @endif>Pyrotech</option>
    @break
    @case('Jedi Guardian')
        <option value="Defense" @if($user->spec === 'Defense') selected @endif>Defense</option>
        <option value="Vigilance" @if($user->spec === 'Vigilance') selected @endif>Vigilance</option>
        <option value="Focus" @if($user->spec === 'Focus') selected @endif>Focus</option>
    @break
    @case('Jedi Sentinel')
        <option value="Watchman" @if($user->spec === 'Watchman') selected @endif>Watchman</option>
        <option value="Combat" @if($user->spec === 'Combat') selected @endif>Combat</option>
        <option value="Concentration" @if($user->spec === 'Concentration') selected @endif>Concentration</option>
    @break
    @case('Jedi Sage')
        <option value="Seer" @if($user->spec === 'Seer') selected @endif>Seer</option>
        <option value="Telekinetics" @if($user->spec === 'Telekinetics') selected @endif>Telekinetics</option>
        <option value="Balance" @if($user->spec === 'Balance') selected @endif>Balance</option>
    @break
    @case('Jedi Shadow')
        <option value="Kinetic Combat" @if($user->spec === 'Kinetic Combat') selected @endif>Kinetic Combat</option>
        <option value="Infiltration" @if($user->spec === 'Infiltration') selected @endif>Infiltration</option>
        <option value="Serenity" @if($user->spec === 'Serenity') selected @endif>Serenity</option>
    @break
    @case('Gunslinger')
        <option value="Sharpshooter" @if($user->spec === 'Sharpshooter') selected @endif>Sharpshooter</option>
        <option value="Saboteur" @if($user->spec === 'Saboteur') selected @endif>Saboteur</option>
        <option value="Dirty Fighting" @if($user->spec === 'Dirty Fighting') selected @endif>Dirty Fighting</option>
    @break
    @case('Scoundrel')
        <option value="Sawbones" @if($user->spec === 'Sawbones') selected @endif>Sawbones</option>
        <option value="Scrapper" @if($user->spec === 'Scrapper') selected @endif>Scrapper</option>
        <option value="Ruffian" @if($user->spec === 'Ruffian') selected @endif>Ruffian</option>
    @break
    @case('Commando')
        <option value="Combat Medic" @if($user->spec === 'Combat Medic') selected @endif>Combat Medic</option>
        <option value="Gunnery" @if($user->spec === 'Gunnery') selected @endif>Gunnery</option>
        <option value="Assault Specialist" @if($user->spec === 'Assault Specialist') selected @endif>Assault Specialist</option>
    @break
    @case('Vanguard')
        <option value="Shield Specialist" @if($user->spec === 'Shield Specialist') selected @endif>Shield Specialist</option>
        <option value="Plasmatech" @if($user->spec === 'Plasmatech') selected @endif>Plasmatech</option>
        <option value="Tactics" @if($user->spec === 'Tactics') selected @endif>Tactics</option>
    @break
    @default
        <option disabled>Сначала сохраните класс персонажа</option>
@endswitch
