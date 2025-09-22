<?php

namespace Tests\Unit;

use App\Enums\Relationship;
use PHPUnit\Framework\TestCase;

class RelationshipTest extends TestCase
{
    public function test_enum_values()
    {
        $this->assertEquals('padre', Relationship::PADRE->value);
        $this->assertEquals('madre', Relationship::MADRE->value);
        $this->assertEquals('conyuge', Relationship::CONYUGE->value);
        $this->assertEquals('hermano', Relationship::HERMANO->value);
        $this->assertEquals('tio', Relationship::TIO->value);
        $this->assertEquals('amigo', Relationship::AMIGO->value);
        $this->assertEquals('otros', Relationship::OTROS->value);
    }

    public function test_get_label()
    {
        $this->assertEquals('Padre', Relationship::PADRE->getLabel());
        $this->assertEquals('Madre', Relationship::MADRE->getLabel());
        $this->assertEquals('Cónyuge', Relationship::CONYUGE->getLabel());
        $this->assertEquals('Hermano(a)', Relationship::HERMANO->getLabel());
        $this->assertEquals('Tío(a)', Relationship::TIO->getLabel());
        $this->assertEquals('Amigo(a)', Relationship::AMIGO->getLabel());
        $this->assertEquals('Otros', Relationship::OTROS->getLabel());
    }

    public function test_get_options()
    {
        $options = Relationship::getOptions();
        
        $expected = [
            'padre' => 'Padre',
            'madre' => 'Madre',
            'conyuge' => 'Cónyuge',
            'hermano' => 'Hermano(a)',
            'tio' => 'Tío(a)',
            'amigo' => 'Amigo(a)',
            'otros' => 'Otros',
        ];
        
        $this->assertEquals($expected, $options);
    }

    public function test_get_family_relationships()
    {
        $familyRelationships = Relationship::getFamilyRelationships();
        
        $this->assertContains(Relationship::PADRE, $familyRelationships);
        $this->assertContains(Relationship::MADRE, $familyRelationships);
        $this->assertContains(Relationship::CONYUGE, $familyRelationships);
        $this->assertContains(Relationship::HERMANO, $familyRelationships);
        
        $this->assertNotContains(Relationship::TIO, $familyRelationships);
        $this->assertNotContains(Relationship::AMIGO, $familyRelationships);
        $this->assertNotContains(Relationship::OTROS, $familyRelationships);
    }

    public function test_get_extended_family_relationships()
    {
        $extendedFamilyRelationships = Relationship::getExtendedFamilyRelationships();
        
        $this->assertContains(Relationship::TIO, $extendedFamilyRelationships);
        
        $this->assertNotContains(Relationship::PADRE, $extendedFamilyRelationships);
        $this->assertNotContains(Relationship::MADRE, $extendedFamilyRelationships);
        $this->assertNotContains(Relationship::CONYUGE, $extendedFamilyRelationships);
        $this->assertNotContains(Relationship::HERMANO, $extendedFamilyRelationships);
        $this->assertNotContains(Relationship::AMIGO, $extendedFamilyRelationships);
        $this->assertNotContains(Relationship::OTROS, $extendedFamilyRelationships);
    }

    public function test_get_non_family_relationships()
    {
        $nonFamilyRelationships = Relationship::getNonFamilyRelationships();
        
        $this->assertContains(Relationship::AMIGO, $nonFamilyRelationships);
        $this->assertContains(Relationship::OTROS, $nonFamilyRelationships);
        
        $this->assertNotContains(Relationship::PADRE, $nonFamilyRelationships);
        $this->assertNotContains(Relationship::MADRE, $nonFamilyRelationships);
        $this->assertNotContains(Relationship::CONYUGE, $nonFamilyRelationships);
        $this->assertNotContains(Relationship::HERMANO, $nonFamilyRelationships);
        $this->assertNotContains(Relationship::TIO, $nonFamilyRelationships);
    }

    public function test_is_family_relationship()
    {
        $this->assertTrue(Relationship::PADRE->isFamilyRelationship());
        $this->assertTrue(Relationship::MADRE->isFamilyRelationship());
        $this->assertTrue(Relationship::CONYUGE->isFamilyRelationship());
        $this->assertTrue(Relationship::HERMANO->isFamilyRelationship());
        $this->assertTrue(Relationship::TIO->isFamilyRelationship());
        
        $this->assertFalse(Relationship::AMIGO->isFamilyRelationship());
        $this->assertFalse(Relationship::OTROS->isFamilyRelationship());
    }

    public function test_is_direct_family_relationship()
    {
        $this->assertTrue(Relationship::PADRE->isDirectFamilyRelationship());
        $this->assertTrue(Relationship::MADRE->isDirectFamilyRelationship());
        $this->assertTrue(Relationship::CONYUGE->isDirectFamilyRelationship());
        $this->assertTrue(Relationship::HERMANO->isDirectFamilyRelationship());
        
        $this->assertFalse(Relationship::TIO->isDirectFamilyRelationship());
        $this->assertFalse(Relationship::AMIGO->isDirectFamilyRelationship());
        $this->assertFalse(Relationship::OTROS->isDirectFamilyRelationship());
    }

    public function test_get_icon()
    {
        $this->assertEquals('👨', Relationship::PADRE->getIcon());
        $this->assertEquals('👩', Relationship::MADRE->getIcon());
        $this->assertEquals('💑', Relationship::CONYUGE->getIcon());
        $this->assertEquals('👫', Relationship::HERMANO->getIcon());
        $this->assertEquals('👨‍👩‍👧‍👦', Relationship::TIO->getIcon());
        $this->assertEquals('👥', Relationship::AMIGO->getIcon());
        $this->assertEquals('❓', Relationship::OTROS->getIcon());
    }

    public function test_get_description()
    {
        $this->assertEquals('Relación paterna', Relationship::PADRE->getDescription());
        $this->assertEquals('Relación materna', Relationship::MADRE->getDescription());
        $this->assertEquals('Pareja o esposo(a)', Relationship::CONYUGE->getDescription());
        $this->assertEquals('Hermano o hermana', Relationship::HERMANO->getDescription());
        $this->assertEquals('Tío o tía', Relationship::TIO->getDescription());
        $this->assertEquals('Amigo o amiga', Relationship::AMIGO->getDescription());
        $this->assertEquals('Otra relación no especificada', Relationship::OTROS->getDescription());
    }

    public function test_is_valid()
    {
        $this->assertTrue(Relationship::isValid('padre'));
        $this->assertTrue(Relationship::isValid('madre'));
        $this->assertTrue(Relationship::isValid('conyuge'));
        $this->assertTrue(Relationship::isValid('hermano'));
        $this->assertTrue(Relationship::isValid('tio'));
        $this->assertTrue(Relationship::isValid('amigo'));
        $this->assertTrue(Relationship::isValid('otros'));
        
        $this->assertFalse(Relationship::isValid('invalid'));
        $this->assertFalse(Relationship::isValid(''));
    }
}
