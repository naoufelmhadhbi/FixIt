import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ItemDeplacementComponent } from './item-deplacement.component';

describe('ItemDeplacementComponent', () => {
  let component: ItemDeplacementComponent;
  let fixture: ComponentFixture<ItemDeplacementComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ItemDeplacementComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ItemDeplacementComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
