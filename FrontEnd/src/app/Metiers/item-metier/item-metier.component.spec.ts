import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ItemMetierComponent } from './item-metier.component';

describe('ItemMetierComponent', () => {
  let component: ItemMetierComponent;
  let fixture: ComponentFixture<ItemMetierComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ItemMetierComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ItemMetierComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
