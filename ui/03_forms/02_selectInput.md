# Select Input

The select UI component, commonly used in web and application interfaces, is a dropdown menu that allows users to choose one option (or sometimes multiple options) from a predefined list.

## Usage

<div>
    <FormsExample example="select" />
</div>

```html
<SelectInput items="$options" label="Number" />
<div>
    You have selected: $selectedOption
</div>
```

```php
<?php

class FormsExample extends BaseComponent
{
    public array $options = [
        'One',
        'Two',
        'Three',
        'Four',
    ];
    public string $selectedOption = '';
}
```

## Using objects

You can use a list of objects for the items. Use `itemTitle` property to set up the title field:

<div>
    <FormsExample example="select-hero" />
</div>

```html
<SelectInput 
    items="$items" 
    itemTitle="Name" 
    label="Chose Hero" 
    model="$selectedHero"
/>
<div if="$selectedHero">
    You have selected: {$selectedHero->Name} ({$selectedHero->Id})
</div>
```

```php
<?php

class FormsExample extends BaseComponent
{
    /**
     * 
     * @var HeroModel[]
     */
    public array $items = [];
    public ?HeroModel $selectedHero = null;

    public function init(): void
    {
        $hero = new HeroModel();
        $hero->Id = 1;
        $hero->Name = 'Superman';        
        $this->items[] = $hero;

        $hero = new HeroModel();
        $hero->Id = 2;
        $hero->Name = 'Batman';
        $this->items[] = $hero;

        $hero = new HeroModel();
        $hero->Id = 3;
        $hero->Name = 'Wonder Woman';
        $this->items[] = $hero;

    }
}
```

## Using associative array

You can use a list of associative objects for the items with `associative` property. Key of the array item will become your value.

<div>
    <FormsExample example="select-hero-assoc" />
</div>

```html
<SelectInput 
    associative 
    items="$itemsAssoc" 
    label="Chose Hero" 
    model="$selectedHeroAssoc"
/>
<div>
    You have selected: $selectedHeroAssoc
</div>
```

```php
<?php

class FormsExample extends BaseComponent
{
    public array $itemsAssoc = [
        'superman' => 'Superman',
        'batman' => 'Batman',
        'wonder-woman' => 'Wonder Woman'
    ];
    public string $selectedHeroAssoc = '';
}
```

## Allow deselecting

If you want to allow deselecting, you can use `nullable` property:

<div>
    <FormsExample example="select-hero-nullable" />
</div>

```html
<SelectInput 
    items="$items" 
    itemTitle="Name" 
    nullable 
    label="Chose Hero" 
    model="$selectedHero"
/>
<div if="$selectedHero">
    You have selected: {$selectedHero->Name} ({$selectedHero->Id})
</div>
```

## Properties

`model` - two-way data binding.

`items` - required, list of options. 

`placeholder` - (optional), placeholder of the input.

`label` - (optional), label text for the input.

`hint` - (optional), hint text for the input.

`associative` - (optional), use associative list for items.

`inputClass` - (optional), class attribute for the input.

`wrapperClass` - (optional), class attribute for the wrapper container.

`id` - (optional), id attribute of the input.

`name` - (optional), name attribute of the input.

`nullable` - (optional), will allow selecting an empty or nullable option.

`itemTitle` - (optional), property of the item that should be used as option title.

`itemValue` - (optional), property of the item that should be used as option value.

`inset` - (optional), boolean, makes the height of the input smaller.

`isInvalid` - (optional), boolean, marks the input as invalid, adds error highlight.

## Events

`(input)` - event that happens when the element gets user input.

## Slots

`default` - (optional), default slot, renders after the hint container.
